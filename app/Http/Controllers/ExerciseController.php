<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function getUserExercises(){
        $user = auth()->user() ?? User::find(1);
        return response()->json([
            'exercises' => $user->calendarEntries->pluck('exercise.exercise_name')->unique()->values()
        ]);
    }

    public function sync(Request $request){
        $request->validate([
            'user_id'=>'required',
            'exercises'=>'required|array'
        ]);

        $user = User::find($request->user_id);

        $exerciseIds = collect($request->exercises)->map(function($name){
            return Exercise::firstOrCreate(
                ['exercise_name'=>$name],
                ['exercise_description'=>'']
            )->exercise_id;
        });

        $user->exercises()->sync($exerciseIds);

        return response()->json(['success'=>true]);
    }
}
