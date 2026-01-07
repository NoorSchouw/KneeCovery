<?php

namespace App\Http\Controllers;

use App\Models\ExerciseExecution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Show list of exercise videos
     */
    public function index()
    {
        // QUICK FIX VERSION: show all executions
        // (you can re-add user filtering later)
        $executions = ExerciseExecution::with('calendarEntry.exercise')->get();

        return view('video', compact('executions'));
    }

    /**
     * Securely stream a video through Laravel
     */
    public function show($execution_id)
    {
        $execution = ExerciseExecution::with('calendarEntry.user')
            ->findOrFail($execution_id);

        // 🔐 Security: only owner can view
        if (
            $execution->calendarEntry->user_id !== Auth::id()
        ) {
            abort(403);
        }

        $path = $execution->execution_video_path;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Video not found');
        }

        return response()->file(
            Storage::disk('public')->path($path),
            [
                'Content-Type' => 'video/webm'
            ]
        );
    }
}
