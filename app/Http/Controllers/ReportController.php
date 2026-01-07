<?php
//
//namespace App\Http\Controllers;
//
//use Illuminate\Http\Request;
//use App\Models\ExerciseExecution;
//use Illuminate\Support\Facades\Auth;
//
//
//class ReportController extends Controller
//{
//    // Pagina laden
//    public function index()
//    {
//        $executions = ExerciseExecution::with('calendarEntry.exercise')->get();
//
//        $executions = $executions->filter(function ($exec) {
//            return $exec->calendarEntry
//                && $exec->calendarEntry->user_id === auth()->id();
//        });
//
//        return view('patient.report', [
//            'executions' => $executions
//        ]);
//    }
//
//    public function getExecutions(Request $request)
//    {
//        $executions = ExerciseExecution::with('calendarEntry.exercise')
//            ->where('execution_date', $request->date)
//            ->whereHas('calendarEntry', function ($q) use ($request) {
//                $q->where('user_id', auth()->id())
//                    ->where('exercise_id', $request->exercise_id);
//            })
//            ->orderBy('start_time')
//            ->get();
//
//        return response()->json($executions);
//    }
//
//}
//


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseExecution;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Pagina laden
    public function index()
    {
        // Eerste execution van de ingelogde patiënt
        $execution = ExerciseExecution::with('calendarEntry.exercise')
            ->whereHas('calendarEntry', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->orderBy('execution_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->first();

        //Debug
        $path = public_path($execution->execution_video_path);
        if (file_exists($path)) {
            dd("File exists at: " . $path);
        } else {
            dd("File NOT found at: " . $path);
        }

        return view('patient.report', [
            'execution' => $execution
        ]);
    }

    // AJAX endpoint om dezelfde execution op te halen
    public function getFirstExecution()
    {
        $execution = ExerciseExecution::with('calendarEntry.exercise')
            ->whereHas('calendarEntry', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->orderBy('execution_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->first();

        return response()->json($execution);
    }
}
