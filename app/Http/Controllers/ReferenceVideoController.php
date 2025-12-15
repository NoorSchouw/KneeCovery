<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\ReferenceVideo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReferenceVideoController extends Controller
{
    /**
     * Upload video + analyse en replace bestaande reference.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exercise' => 'required|string',
            'video'    => 'nullable|file|mimes:mp4,mov,avi,webm|max:512000',
            'payload'  => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        // Zoek of maak oefening aan
        $exercise = Exercise::firstOrCreate(['exercise_name' => $request->exercise]);

        // Oude reference verwijderen (want maar 1 actieve reference)
        $old = ReferenceVideo::where('exercise_id', $exercise->exercise_id)->first();
        if ($old) {
            if ($old->video_path && Storage::disk('public')->exists($old->video_path)) {
                Storage::disk('public')->delete($old->video_path);
            }
            $old->delete();
        }

        $video_url = null;
        $video_path = null;

        // --- VIDEO UPLOADEN ---
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('videos', $filename, 'public');

            $video_path = $path;
            $video_url = asset('storage/'.$path); // <- VIDEOLINK voor frontend
        }

        // JSON payload fixen (string → array)
        $payload = $request->payload;
        if (is_string($payload)) {
            $payload = json_decode($payload, true);
        }

        // Nieuwe reference opslaan
        $ref = ReferenceVideo::create([
            'exercise_id' => $exercise->exercise_id,
            'video_path'  => $video_path,
            'video_url'   => $video_url,
            'payload'     => $payload ?? []
        ]);

        return response()->json([
            'success'   => true,
            'video_url' => $ref->video_url,
            'payload'   => $ref->payload
        ]);
    }


    /**
     * Opslaan van analyse zonder video upload
     */
    public function saveAnalysis(Request $request)
    {
        $request->validate([
            'exercise' => 'required|string',
            'payload'  => 'required|array'
        ]);

        $exercise = Exercise::firstOrCreate(['exercise_name'=>$request->exercise]);

        $ref = ReferenceVideo::updateOrCreate(
            ['exercise_id' => $exercise->exercise_id],
            ['payload' => $request->payload]
        );

        return response()->json([
            'success'=>true,
            'payload'=>$ref->payload
        ]);
    }


    /**
     * Ophalen reference video + analyse voor detail modal
     */
    public function get($exercise)
    {
        $ref = ReferenceVideo::whereHas('exercise',
            fn($q)=>$q->where('exercise_name',$exercise)
        )
            ->latest()
            ->first();

        return $ref
            ? response()->json([
                'video_url'=>$ref->video_url,
                'payload'=>$ref->payload
            ])
            : response()->json(['status'=>'not_found'],404);
    }
}
