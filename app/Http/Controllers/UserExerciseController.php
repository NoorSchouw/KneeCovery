<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserExerciseController extends Controller
{
    // fetch list in left panel
    public function index(Request $request)
    {
        $user_id = $request->user_id ?? 1;

        $exercises = DB::table('exercise_user')
            ->join('exercise','exercise.exercise_id','=','exercise_user.exercise_id')
            ->where('user_id',$user_id)
            ->pluck('exercise.exercise_name');

        return response()->json(['exercises'=>$exercises]);
    }

    // sync complete list (used by your JS)
    public function sync(Request $request)
    {
        $user_id = $request->user_id ?? 1;
        $names   = $request->exercises ?? [];

        DB::table('exercise_user')->where('user_id',$user_id)->delete();

        foreach($names as $name){
            $exercise = Exercise::firstOrCreate(['exercise_name'=>$name]);
            DB::table('exercise_user')->insert([
                'user_id'=>$user_id,
                'exercise_id'=>$exercise->exercise_id
            ]);
        }

        return ['success'=>true];
    }
}
