<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PatientExerciseController;
use App\Http\Controllers\FysioController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\AddPatientsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//------------------------------------------------General-------------------------------------
Route::get('/', [LoginController::class, 'showLogin'])->name('login.show');
Route::post('/', [LoginController::class, 'login'])->name('login.perform');

Route::get('/homepage', function () {
    return 'Welcome to your personal homepage!';
})->middleware('auth');

Route::get('/signup', [SignUpController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [SignUpController::class, 'createUser'])->name('signup.create');

Route::get('/forgot-password', function () {
    return view('forgot_password');
});
Route::get('/privacy-policy', function () {
    return view('privacy');
});

//---------------------------------------------------- Patient -------------------------------
Route::get('/homepage', function () {
    return view('homepage');
});
Route::get('/calendar', function () {
    return view('patient/calendar');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/all-exercises', [PatientExerciseController::class, 'index'])
        ->name('patient.exercises');
});

Route::get('/patient-report', function () {
    return view('/patient/report');
});
Route::get('/information', function () {
    return view('/patient/information');
});
Route::get('/filming', function () {
    return view('/patient/filming');
});

//----------------------------------------------------Physio----------------------------------
Route::get('/report', function () {
    return view('/fysio/report');
});

Route::get('/patients/{user}/report', [AddPatientsController::class, 'report'])
    ->name('patients.report');

Route::get('/upload-exercises', function () {
    return view('/fysio/upload_exercises');
});
//Route::get('/patients', function () {
   // return view('/fysio/patients');
//});

//------------------------------- Tracking -------------------------------------------------
Route::get('/motion', function () {
    return view('motion');
});

Route::get('/fysio', [FysioController::class, 'showUploadPage']);
Route::post('/fysio/upload', [FysioController::class, 'uploadVideo'])->name('fysio.upload');
Route::post('/fysio/analyze', [FysioController::class, 'analyzeVideo'])->name('fysio.analyze');

Route::get('/videos/{file}', function ($file) {
    if (!Storage::disk('public')->exists('videos/' . $file)) {
        abort(404);
    }
    return Storage::disk('public')->response('videos/' . $file);
})->where('file', '.*');

Route::get('/data/{file}', function ($file) {
    if (!Storage::disk('public')->exists('data/' . $file)) {
        abort(404);
    }
    return Storage::disk('public')->get('data/' . $file);
})->where('file', '.*');

Route::get('/patient', [PatientController::class, 'showTrackingPage'])->name('patient.track');
Route::get('/patient/{exercise}', [PatientController::class, 'track']);
Route::post('/sessions', [PatientController::class, 'storeSession']);
Route::get('/references/latest', [PatientController::class, 'getLatestReference']);
Route::post('/references', [FysioController::class, 'storeReference'])->name('references.store');
Route::get('/references/{exercise}', [FysioController::class, 'getReference'])->name('references.get');

//-----------------------------AddPatients---------------------------------------------------------

Route::resource('patients', AddPatientsController::class);


