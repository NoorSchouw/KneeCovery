<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    // Haal oefeningen op voor een specifieke patiënt (user uit URL)
    public function getUserExercises(User $user)
    {
        return response()->json([
            'exercises' => $user->calendarEntries
                ->pluck('exercise.exercise_name')
                ->unique()
                ->values()
        ]);
    }

    // Sync oefeningen naar een specifieke patiënt
    public function sync(Request $request, User $user)
    {
        $request->validate([
            'exercises' => 'required|array'
        ]);

        $exerciseIds = collect($request->exercises)->map(function ($name) {
            return Exercise::firstOrCreate(
                ['exercise_name' => $name],
                ['exercise_description' => '']
            )->exercise_id;
        });

        // Belangrijk: gebruik de User uit de URL ($user), NIET auth()->user()
        $user->exercises()->sync($exerciseIds);

        return response()->json(['success' => true]);
    }
}
