<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FysioController;
use App\Http\Controllers\PatientController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/motion', function () {
    return view('motion');
});

// Fysio pagina (video upload en analyse)
Route::get('/fysio', [FysioController::class, 'showUploadPage']);
Route::post('/fysio/upload', [FysioController::class, 'uploadVideo'])->name('fysio.upload');
Route::post('/fysio/analyze', [FysioController::class, 'analyzeVideo'])->name('fysio.analyze');

// Serve public videos via Laravel to avoid webserver 403 on /storage
Route::get('/videos/{file}', function ($file) {
    if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('videos/' . $file)) {
        abort(404);
    }
    return \Illuminate\Support\Facades\Storage::disk('public')->response('videos/' . $file);
})->where('file', '.*');

// Serve public data files (JSON) via Laravel
Route::get('/data/{file}', function ($file) {
    if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('data/' . $file)) {
        abort(404);
    }
    return \Illuminate\Support\Facades\Storage::disk('public')->get('data/' . $file);
})->where('file', '.*');

// Patient pagina
Route::get('/patient', [PatientController::class, 'showTrackingPage']);

// Nieuwe routes voor referentie JSON en sessies
Route::get('/patient/track/{exercise}', [PatientController::class, 'track'])->name('patient.track');
Route::post('/sessions', [PatientController::class, 'storeSession'])->name('sessions.store');
Route::post('/references', [FysioController::class, 'storeReference'])->name('references.store');
Route::get('/references/{exercise}', [FysioController::class, 'getReference'])->name('references.get');

// Endpoint voor patient om laatste referentie JSON op te halen (blijft voorlopig voor backward compat.)
Route::get('/patient/data/latest', [PatientController::class, 'getLatestReference']);

Route::get('/patient', [PatientController::class, 'showTrackingPage'])->name('patient.track');
Route::get('/patient/{exercise}', [PatientController::class, 'track']);
Route::post('/sessions', [PatientController::class, 'storeSession']);
Route::get('/references/latest', [PatientController::class, 'getLatestReference']);
