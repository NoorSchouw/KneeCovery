<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FysioController extends Controller
{
    // 1️⃣ Pagina tonen
    public function showUploadPage()
    {
        return view('fysio.upload'); // upload.blade.php
    }

    // 2️⃣ Video uploaden
    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,mov,avi|max:20000', // max 20MB
        ]);

        $file = $request->file('video');
        $filename = 'video_' . time() . '.' . $file->getClientOriginalExtension();

        // Opslaan in storage/app/public/videos met expliciete public disk
        \Illuminate\Support\Facades\Storage::disk('public')->putFileAs('videos', $file, $filename);

        return response()->json(['status' => 'success', 'file' => $filename]);
    }

    // 3️⃣ Analyse JSON opslaan (legacy)
    public function analyzeVideo(Request $request)
    {
        $data = $request->all();
        $filename = 'video_' . time() . '.json';
        Storage::disk('public')->put('data/' . $filename, json_encode($data, JSON_PRETTY_PRINT));
        return response()->json(['status' => 'success', 'file' => $filename]);
    }

    // 4️⃣ Nieuwe: referentie JSON opslaan met exercise label
    public function storeReference(Request $request)
    {
        $validated = $request->validate([
            'exercise' => 'required|string',
            'payload' => 'required|array',
        ]);

        $filename = 'reference_' . preg_replace('/[^a-z0-9_\-]/i','_', $validated['exercise']) . '_' . time() . '.json';
        Storage::disk('public')->put('data/' . $filename, json_encode($validated['payload'], JSON_PRETTY_PRINT));
        return response()->json([
            'status' => 'success',
            'file' => $filename,
            'url' => Storage::url('data/' . $filename)
        ]);
    }

    // 5️⃣ Nieuwe: laatste referentie ophalen per exercise
    public function getReference(string $exercise)
    {
        $files = Storage::files('public/data');
        $exercise = preg_replace('/[^a-z0-9_\-]/i','_', $exercise);
        $matches = array_values(array_filter($files, fn($f) => str_contains($f, 'reference_' . $exercise . '_')));
        if (empty($matches)) {
            return response()->json(['status' => 'not_found'], 404);
        }
        usort($matches, fn($a,$b) => Storage::lastModified($b) - Storage::lastModified($a));
        $latest = $matches[0];
        return response()->json([
            'status' => 'success',
            'url' => Storage::url($latest),
            'file' => basename($latest)
        ]);
    }
}
