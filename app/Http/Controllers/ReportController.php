<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseExecution;

class ReportController extends Controller
{
    // Pagina laden
    public function index()
    {
        $exercises = ExerciseExecution::select('assignment_id')
            ->distinct()
            ->get();

        return view('patient.report', compact('exercises'));
    }


    // Data ophalen via filters
    public function getExecutions(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'exercise_id' => 'required|integer'
        ]);

        $videos = Video::where('execution_date', $request->date)
            ->where('assignment_id', $request->exercise_id)
            ->orderBy('start_time')
            ->get();

        // Map naar frontend velden
        $executions = $videos->map(function ($video) {
            return [
                'start_time' => $video->time,
                'execution_video_path' => $video->filepath,
                'feedback' => $video->patient_report,
                'score' => $video->percentage,
            ];
        });

        return response()->json($executions);
    }
}
