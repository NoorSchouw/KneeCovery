<?php

namespace App\Http\Controllers;

use App\Models\CalendarEntry;
use App\Models\ExerciseExecution;
use Illuminate\Http\Request;

class ReportPhysioController extends Controller
{
    // Hulpfunctie om geselecteerde patient te krijgen
    private function patientId(): int
    {
        return session('selected_patient_id'); // of andere manier van opslaan
    }

    // Pagina laden
    public function index()
    {
        $patientId = $this->patientId();

        // Alle executions van geselecteerde patient
        $executions = ExerciseExecution::with('calendarEntry.exercise')
            ->whereHas('calendarEntry', function ($q) use ($patientId) {
                $q->where('user_id', $patientId);
            })
            ->orderBy('execution_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        // Eerste execution als default selectie
        $firstExecution = $executions->first();

        return view('fysio.report', [
            'execution'  => $firstExecution,
            'executions' => $executions,
        ]);
    }

    // Execution ophalen via AJAX
    public function executionById($executionId)
    {
        $execution = ExerciseExecution::with('calendarEntry.exercise')->find($executionId);

        if (!$execution) {
            return response()->json(null);
        }

        return response()->json([
            'execution_id'     => $execution->execution_id,
            'feedback'         => $execution->feedback,
            'match_percentage' => round($execution->match_percentage),
            'video_url'        => $execution->execution_video_path ? url('/video/' . $execution->execution_id) : null,
            'exercise_name'    => optional($execution->calendarEntry->exercise)->exercise_name,
            'execution_date'   => $execution->execution_date,
            'start_time'       => $execution->start_time,
        ]);
    }
}
