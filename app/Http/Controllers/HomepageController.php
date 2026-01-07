<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomepageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        /** --------------------
         * CALENDAR ENTRIES
         * -------------------- */
        $calendarEntries = DB::table('calendar_entries as ce')
            ->join('exercise as e', 'ce.exercise_id', '=', 'e.exercise_id')
            ->where('ce.user_id', $user->user_id)
            ->select(
                'ce.date',
                'e.exercise_name',
                'ce.settings'
            )
            ->orderBy('ce.date')
            ->get()
            ->groupBy('date');

        /** --------------------
         * EXERCISES (dropdown)
         * -------------------- */
        $exercises = DB::table('exercise')
            ->select('exercise_id', 'exercise_name')
            ->get();

        return view('homepage', [
            'today'          => $today,
            'calendarEntries'=> $calendarEntries,
            'exercises'      => $exercises,
        ]);
    }

    public function calendarByDate($date)
    {
        $user = auth()->user();

        $entries = DB::table('calendar_entries as ce')
            ->join('exercise as e', 'ce.exercise_id', '=', 'e.exercise_id')
            ->where('ce.user_id', $user->user_id)
            ->whereDate('ce.date', $date)
            ->select(
                'e.exercise_name',
                'ce.settings'
            )
            ->get();

        return response()->json(
            $entries->map(function ($entry) {
                $settings = json_decode($entry->settings, true);
                return [
                    'name' => $entry->exercise_name,
                    'frequency' => $settings['frequency'] ?? null,
                ];
            })
        );
    }

    public function progress(Request $request)
    {
        $userId = Auth::user()->user_id;
        $exercise = $request->exercise;
        $range = $request->range ?? 'week';

        $startDate = match ($range) {
            '2weeks' => now()->subWeeks(2),
            'month'  => now()->subMonth(),
            default  => now()->subWeek(),
        };

        $data = DB::table('excerciseExecution as ee')
            ->join('calendar_entries as ce', 'ee.calendar_entry_id', '=', 'ce.id')
            ->join('exercise as e', 'ce.exercise_id', '=', 'e.exercise_id')
            ->where('ce.user_id', $userId)
            ->where('e.exercise_name', $exercise)
            ->whereDate('ee.execution_date', '>=', $startDate)
            ->orderBy('ee.execution_date')
            ->select(
                'ee.execution_date',
                'ee.match_percentage'
            )
            ->get();

        return response()->json($data);
    }

    public function kneeMetrics(Request $request): \Illuminate\Http\JsonResponse
    {
        $userId = Auth::user()->user_id;
        $exercise = $request->exercise;
        $range = $request->range ?? 'week';

        $startDate = match ($range) {
            '2weeks' => now()->subWeeks(2),
            'month'  => now()->subMonth(),
            default  => now()->subWeek(),
        };

        $data = DB::table('excerciseExecution as ee')
            ->join('calendar_entries as ce', 'ee.calendar_entry_id', '=', 'ce.id')
            ->join('exercise as e', 'ce.exercise_id', '=', 'e.exercise_id')
            ->where('ce.user_id', $userId)
            ->where('e.exercise_name', $exercise)
            ->whereDate('ee.execution_date', '>=', $startDate)
            ->orderBy('ee.execution_date')
            ->select(
                'ee.execution_date',
                'ee.min_angle',
                'ee.max_angle'
            )
            ->get();

        return response()->json($data);
    }

}
