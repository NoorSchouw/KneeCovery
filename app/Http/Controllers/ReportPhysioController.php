<?php

namespace App\Http\Controllers;

use App\Models\CalendarEntry;
use App\Models\ExerciseExecution;
use App\Models\User; // ⬅️ add this!
use Illuminate\Http\Request;

class ReportPhysioController extends Controller
{
    private function patientId(): int
    {
        return session('selected_patient_id');
    }

    public function index()
    {
        $patientId = $this->patientId();

        // ⬅️ Fetch selected patient
        $patient = User::find($patientId);

        $executions = ExerciseExecution::with('calendarEntry.exercise')
            ->whereHas('calendarEntry', function ($q) use ($patientId) {
                $q->where('user_id', $patientId);
            })
            ->orderBy('execution_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        $firstExecution = $executions->first();

        return view('fysio.report', [
            'execution'  => $firstExecution,
            'executions' => $executions,
            'patient'    => $patient, // ⬅️ extra data for view
        ]);
    }

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
