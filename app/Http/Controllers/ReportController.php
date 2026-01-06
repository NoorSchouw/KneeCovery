<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseExecution;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    // Pagina laden
    public function index()
    {
        $executions = ExerciseExecution::with('assignment.exercise')->get();

        // Filter out executions zonder assignment
        $executions = $executions->filter(function($exec){
            return $exec->assignment !== null && $exec->assignment->exercise !== null;
        });

        // DEBUG: voeg veilig null checks toe
        foreach ($executions as $exec) {
            $exerciseName = optional($exec->assignment->exercise)->exercise_name ?? 'NO EXERCISE';
            $assignmentId = $exec->assignment_id ?? 'NULL';
            logger("Execution {$exec->execution_id}: assignment_id={$assignmentId}, exercise={$exerciseName}");
        }

        return view('patient.report', [
            'executions' => $executions
        ]);
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
