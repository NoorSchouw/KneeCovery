<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PatientExerciseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Load patient (may be null if no patient record)
        $patient = $user->patient()->with('exercises')->first();

        // If patient doesn't exist, still show the page with a message
        $exercises = $patient?->exercises ?? collect();

        return view('patient.exercises', [
            'patient'   => $patient,
            'exercises' => $exercises,
        ]);
    }
}
