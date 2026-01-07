<?php

namespace App\Http\Controllers;

use App\Models\CalendarEntry;
use App\Models\Exercise;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    // Selected patient from addPatients page
    private function patientId(): int
    {
        return session('selected_patient_id');
    }

    public function getUserCalendar(Request $request){
        $id = $this->patientId();

        $entries = CalendarEntry::with('exercise')
            ->where('user_id',$id)
            ->get()
            ->map(fn($c)=>[
                'id' => $c->id, // 👈 DIT IS DE CRUCIALE REGEL
                'exercise' => $c->exercise->exercise_name,
                'date' => $c->date->format('Y-m-d'),
                'settings' => $c->settings
            ]);


        return response()->json(['entries'=>$entries]);
    }

    public function todayExercises()
    {
        $today = now()->toDateString();

        $entries = CalendarEntry::with('exercise')
            ->where('user_id', $this->patientId())
            ->whereDate('date', $today)
            ->get()
            ->map(fn($c)=>[
                'id' => $c->id, // 👈 BELANGRIJK
                'exercise' => $c->exercise->exercise_name,
                'settings' => $c->settings,
                'date' => $c->date->format('Y-m-d'),
            ]);

        return response()->json($entries);
    }


    public function store(Request $request){
        $request->validate([
            'exercise'=>'required|string',
            'date'=>'required|date',
            'settings'=>'nullable|array'
        ]);

        /** ensure exercise exists */
        $exercise = Exercise::firstOrCreate(['exercise_name'=>$request->exercise]);

        /** create or update calendar row */
        $entry = CalendarEntry::updateOrCreate(
            ['user_id'=>$this->patientId(),'exercise_id'=>$exercise->exercise_id,'date'=>$request->date],
            ['settings'=>$request->settings]
        );

        return response()->json(['success'=>true,'entry'=>$entry]);
    }

    public function update(Request $request){
        $request->validate([
            'exercise'=>'required',
            'date'=>'required|date',
            'settings'=>'nullable|array'
        ]);

        $exercise = Exercise::where('exercise_name',$request->exercise)->first();
        if(!$exercise) return response()->json(['success'=>false,'msg'=>'exercise missing'],404);

        $updated = CalendarEntry::where('user_id',$this->patientId())
            ->where('exercise_id',$exercise->exercise_id)
            ->where('date',$request->date)
            ->update(['settings'=>$request->settings]);

        return response()->json(['success'=>true,'updated'=>$updated]);
    }
    public function deleteDay(Request $request){
        $request->validate([
            'exercise'=>'required|string',
            'date'=>'required|date'
        ]);

        $exercise = Exercise::where('exercise_name',$request->exercise)->first();
        if(!$exercise) return response()->json(['error'=>'Exercise not found'],404);

        CalendarEntry::where('user_id',$this->patientId())
            ->where('exercise_id',$exercise->exercise_id)
            ->whereDate('date',$request->date)
            ->delete();

        return response()->json(['success'=>true]);
    }


    public function deleteWeek(Request $request){
        $request->validate([
            'exercise'=>'required|string',
            'start'=>'required|date',   // monday of week
            'end'=>'required|date'      // sunday of week
        ]);

        $exercise = Exercise::where('exercise_name',$request->exercise)->first();
        if(!$exercise) return response()->json(['error'=>'Exercise not found'],404);

        CalendarEntry::where('user_id',$this->patientId())
            ->where('exercise_id',$exercise->exercise_id)
            ->whereBetween('date',[$request->start,$request->end])
            ->delete();

        return response()->json(['success'=>true]);
    }
}
