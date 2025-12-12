<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    /**
     * Toon trackingpagina met laatste referentie (ongeacht oefening)
     */
    public function showTrackingPage()
    {
        $files = Storage::disk('public')->files('data');
        $latestJson = null;

        if (!empty($files)) {
            // Sorteer op laatste wijziging
            usort($files, fn($a, $b) => Storage::disk('public')->lastModified($b) - Storage::disk('public')->lastModified($a));
            $filename = str_replace('data/', '', $files[0]);
            $latestJson = '/data/' . $filename;
        }

        return view('patient.track', [
            'referenceJson' => $latestJson
        ]);
    }

    /**
     * Toon trackingpagina voor een specifieke oefening
     */
    public function track(string $exercise)
    {
        $files = Storage::disk('public')->files('data');
        $exercise = preg_replace('/[^a-z0-9_\-]/i', '_', $exercise);
        $matches = array_values(array_filter($files, fn($f) => str_contains($f, 'reference_' . $exercise . '_')));

        $latestJson = null;
        if (!empty($matches)) {
            usort($matches, fn($a, $b) => Storage::disk('public')->lastModified($b) - Storage::disk('public')->lastModified($a));
            $filename = str_replace('data/', '', $matches[0]);
            $latestJson = '/data/' . $filename;
        }

        return view('patient.track', [
            'referenceJson' => $latestJson
        ]);
    }

    /**
     * Opslaan van patiëntsessie (samenvatting in JSON)
     */
    public function storeSession(Request $request)
    {
        $validated = $request->validate([
            'exercise' => 'required|string',
            'summary' => 'required|array',
        ]);

        $filename = 'session_' . preg_replace('/[^a-z0-9_\-]/i', '_', $validated['exercise']) . '_' . time() . '.json';
        Storage::disk('public')->put('data/' . $filename, json_encode($validated['summary'], JSON_PRETTY_PRINT));

        return response()->json([
            'status' => 'success',
            'file' => $filename
        ]);
    }

    /**
     * API endpoint: geef laatste referentie (ongeacht oefening)
     */
    public function getLatestReference()
    {
        $files = Storage::disk('public')->files('data');
        if (empty($files)) {
            return response()->json(['status' => 'not_found'], 404);
        }

        usort($files, fn($a, $b) => Storage::disk('public')->lastModified($b) - Storage::disk('public')->lastModified($a));

        $filename = str_replace('data/', '', $files[0]);
        return response()->json([
            'status' => 'success',
            'url' => '/data/' . $filename
        ]);
    }
}
