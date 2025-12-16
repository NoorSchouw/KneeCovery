<?php

namespace App\Http\Controllers;

use App\Models\ExerciseExecution;
use App\Models\CalendarEntry;
use App\Services\ExecutionFeedbackService;
use Illuminate\Http\Request;

class ExerciseExecutionController extends Controller
{
    public function store(Request $request)
    {
        /* 1️⃣ VALIDATIE */
        $request->validate([
            'calendar_entry_id' => 'required|exists:calendar_entries,id',
            'score' => 'required|numeric|min:0|max:100',
            'match_percentage' => 'required|numeric|min:0|max:100',
            'min_angle' => 'nullable|numeric|min:0|max:180',
            'max_angle' => 'nullable|numeric|min:0|max:180',
            'duration' => 'required|numeric|min:1',
            'video' => 'required|file',
        ]);

        /* 2️⃣ REFERENTIE + FEEDBACK */
        $entry = CalendarEntry::findOrFail($request->calendar_entry_id);
        $settings = $entry->settings;
        $analysis = $settings['analysis'] ?? null;

        if (!$analysis) {
            $feedback = "No reference analysis available for this exercise.";
        } else {
            $feedback = ExecutionFeedbackService::generate([
                'match_percentage' => $request->match_percentage,
                'min_angle' => $request->min_angle,
                'max_angle' => $request->max_angle,
                'reference_peak' => $analysis['peakAngle'],
                'direction' => $analysis['direction'],
            ]);
        }

        /* 3️⃣ VIDEO OPSLAAN */
        $path = $request->file('video')->store('exercise_videos', 'public');

        /* 4️⃣ TIJDEN BEREKENEN */
        $start = now();
        $end = now()->addSeconds((int) $request->duration);

        /* 5️⃣ EXECUTION OPSLAAN */
        $execution = ExerciseExecution::create([
            'calendar_entry_id' => $request->calendar_entry_id,
            'execution_date' => now()->toDateString(),
            'feedback' => $feedback,
            'score' => (int) round($request->score),
            'match_percentage' => $request->match_percentage,
            'min_angle' => $request->min_angle,
            'max_angle' => $request->max_angle,
            'start_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
            'duration' => gmdate('H:i:s', $request->duration),
            'execution_video_path' => $path,
        ]);

        /* 6️⃣ RESPONSE */
        return response()->json([
            'success' => true,
            'execution' => [
                'id' => $execution->execution_id,
                'date' => $execution->execution_date,

                // 🦵 Oefening
                'exercise' => $entry->exercise->exercise_name,
                'direction' => $analysis['direction'] ?? null,

                // 📊 Metingen
                'match_percentage' => $execution->match_percentage,
                'min_angle' => $execution->min_angle,
                'max_angle' => $execution->max_angle,

                // ⏱ Tijden
                'start_time' => $execution->start_time,
                'end_time'   => $execution->end_time,
                'duration'   => $execution->duration,

                // 💬 Feedback
                'feedback' => $execution->feedback,

                // 🎥 Video
                'video_path' => asset('storage/' . $execution->execution_video_path),
                'video_url'  => url('/video/' . $execution->execution_id),
            ]
        ]);
    }
}
