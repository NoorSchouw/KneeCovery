<?php

namespace App\Http\Controllers;

use App\Models\CalendarEntry;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * Alle calendar entries van ingelogde gebruiker
     */
    public function getUserCalendar()
    {
        $userId = Auth::id();

        $entries = CalendarEntry::with('exercise')
            ->where('user_id', $userId)
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'exercise' => $c->exercise->exercise_name,
                'date' => $c->date->format('Y-m-d'),
                'settings' => $c->settings,
            ]);

        return response()->json(['entries' => $entries]);
    }

    /**
     * Oefeningen van vandaag voor ingelogde gebruiker
     */
    public function todayExercises()
    {
        $userId = Auth::id();
        $today = now()->toDateString();

        $entries = CalendarEntry::with('exercise')
            ->where('user_id', $userId)
            ->whereDate('date', $today)
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'exercise' => $c->exercise->exercise_name,
                'settings' => $c->settings,
                'date' => $c->date->format('Y-m-d'),
            ]);

        return response()->json($entries);
    }

    /**
     * Toevoegen of updaten van een calendar entry
     */
    public function store(Request $request)
    {
        $request->validate([
            'exercise' => 'required|string',
            'date' => 'required|date',
            'settings' => 'nullable|array',
        ]);

        $userId = Auth::id();

        // Ensure exercise exists
        $exercise = Exercise::firstOrCreate([
            'exercise_name' => $request->exercise,
        ]);

        // Create or update calendar entry
        $entry = CalendarEntry::updateOrCreate(
            [
                'user_id' => $userId,
                'exercise_id' => $exercise->exercise_id,
                'date' => $request->date,
            ],
            [
                'settings' => $request->settings,
            ]
        );

        return response()->json(['success' => true, 'entry' => $entry]);
    }

    /**
     * Update settings van een specifieke dag
     */
    public function update(Request $request)
    {
        $request->validate([
            'exercise' => 'required|string',
            'date' => 'required|date',
            'settings' => 'nullable|array',
        ]);

        $userId = Auth::id();

        $exercise = Exercise::where('exercise_name', $request->exercise)->first();
        if (!$exercise) {
            return response()->json(['success' => false, 'msg' => 'Exercise not found'], 404);
        }

        $updated = CalendarEntry::where('user_id', $userId)
            ->where('exercise_id', $exercise->exercise_id)
            ->whereDate('date', $request->date)
            ->update([
                'settings' => $request->settings,
            ]);

        return response()->json(['success' => true, 'updated' => $updated]);
    }

    /**
     * Verwijder oefening op één dag
     */
    public function deleteDay(Request $request)
    {
        $request->validate([
            'exercise' => 'required|string',
            'date' => 'required|date',
        ]);

        $userId = Auth::id();

        $exercise = Exercise::where('exercise_name', $request->exercise)->first();
        if (!$exercise) {
            return response()->json(['error' => 'Exercise not found'], 404);
        }

        CalendarEntry::where('user_id', $userId)
            ->where('exercise_id', $exercise->exercise_id)
            ->whereDate('date', $request->date)
            ->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Verwijder oefening voor een volledige week
     */
    public function deleteWeek(Request $request)
    {
        $request->validate([
            'exercise' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $userId = Auth::id();

        $exercise = Exercise::where('exercise_name', $request->exercise)->first();
        if (!$exercise) {
            return response()->json(['error' => 'Exercise not found'], 404);
        }

        CalendarEntry::where('user_id', $userId)
            ->where('exercise_id', $exercise->exercise_id)
            ->whereBetween('date', [$request->start, $request->end])
            ->delete();

        return response()->json(['success' => true]);
    }
}
