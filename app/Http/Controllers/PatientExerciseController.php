<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientExerciseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch all calendar entries for this patient along with exercise info and reference video
        $calendarEntries = DB::table('calendar_entries as ce')
            ->leftJoin('exercise as e', 'ce.exercise_id', '=', 'e.exercise_id')
            ->leftJoin('reference_videos as rv', 'ce.exercise_id', '=', 'rv.exercise_id')
            ->where('ce.user_id', $user->user_id)
            ->select(
                'ce.id as calendar_entry_id',
                'ce.date',
                'ce.settings',
                'e.exercise_name',
                'e.exercise_description',
                'rv.video_path as exercise_video_path',
                'rv.video_url as exercise_video_url'
            )
            ->orderBy('ce.date')
            ->get();


        // Map settings JSON to extract frequency, analysis, and check if scheduled for today
        $exercises = $calendarEntries->map(function ($entry) {
            $settings = json_decode($entry->settings, true);
            $date = Carbon::parse($entry->date);
            $isToday = $date->isToday();

            return (object) [
                'calendar_entry_id'     => $entry->calendar_entry_id,
                'date'                  => $entry->date,
                'exercise_name'         => $entry->exercise_name,
                'exercise_description'  => $entry->exercise_description,
                'exercise_video_path'   => $entry->exercise_video_path,
                'exercise_video_url'    => $entry->exercise_video_url,
                'frequency'             => $settings['frequency'] ?? null,
                'analysis'              => $settings['analysis'] ?? null,
                'is_today'              => $isToday,
            ];
        })
        ->unique('exercise_name')
        ->values(); // reindex collection

        return view('patient.exercises', [
            'patient' => $user->patient,
            'exercises' => $exercises,
        ]);
    }
}
