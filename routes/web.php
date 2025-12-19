<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReferenceVideoController;
use App\Http\Controllers\UserExerciseController;
use App\Http\Controllers\PatientCalendarController;
use App\Http\Controllers\ExerciseExecutionController;
use App\Http\Controllers\AddPatientsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InformationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

// ------------------ General ------------------
Route::get('/', [LoginController::class, 'showLogin'])->name('login.show');
Route::post('/', [LoginController::class, 'login'])->name('login.perform');

Route::get('/signup', [SignUpController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [SignUpController::class, 'createUser'])->name('signup.create');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/forgot-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

Route::get('/privacy-policy', function () {
    return view('privacy');
});
Route::get('/contact', function () {
    return view('contact');
});

// ------------------ Patient ------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/homepage', function () {
        return view('homepage');
    });

    Route::get('/calendar', function () {
        return view('patient/calendar');
    });
    Route::get('/calendar-data', [PatientCalendarController::class, 'getUserCalendar']);

    Route::get('/all-exercises', function () {
        return view('patient/exercises');
    });

    Route::get('/filming', function () {
        return view('patient/filming');
    });

    Route::get('/information', [InformationController::class, 'information'])->name('patient.information');
    Route::post('/information/update', [InformationController::class, 'update'])->name('patient.information.update');

    Route::get('/patient-report', [ReportController::class, 'index']);
    Route::get('/report/get-executions', [ReportController::class, 'getExecutions']);

    // Today exercises
    Route::get('/patient/today-exercises/{user}', [CalendarController::class, 'todayExercises']);
});

// ------------------ Physio ------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/patients', function () {
        return view('fysio/patients');
    });

    Route::get('/patients/{user}/report', [AddPatientsController::class, 'report'])
        ->name('patients.report'); // upload-exercises pagina is hieraan gekoppeld

    // Oefeningen voor een specifieke patiënt ophalen
    Route::get('/patients/{user}/exercises', [ExerciseController::class, 'getUserExercises'])
        ->name('patients.exercises.get');

    // Oefeningen toevoegen voor een specifieke patiënt
    Route::post('/patients/{user}/exercises/sync', [ExerciseController::class, 'sync'])
        ->name('patients.exercises.sync');

    // User calendar (fysio view)
    Route::get('/user-calendar', [CalendarController::class, 'getUserCalendar']);
    Route::post('/calendar-exercise', [CalendarController::class, 'store']);
    Route::post('/calendar-update', [CalendarController::class,'update']);
    Route::post('/calendar-exercise/delete-day',[CalendarController::class,'deleteDay']);
    Route::post('/calendar-exercise/delete-week',[CalendarController::class,'deleteWeek']);
});

// ------------------ Video & Reference routes ------------------
Route::post('/reference-video',[ReferenceVideoController::class,'store'])->name('reference.video');
Route::post('/reference-analysis',[ReferenceVideoController::class,'saveAnalysis'])->name('reference.analysis');
Route::get('/reference/{exercise}',[ReferenceVideoController::class,'get'])->name('reference.get');

Route::post('/exercise/store', [ExerciseExecutionController::class, 'store']);
Route::post('/exercise-executions', [ExerciseExecutionController::class, 'store']);

Route::get('/videos/{file}', function($file){
    $path = storage_path('app/public/videos/' . $file);
    if (!file_exists($path)) abort(404);
    return response()->file($path, [
        'Content-Type' => 'video/mp4',
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization'
    ]);
});

Route::get('/data/{file}', function($file){
    if (!Storage::disk('public')->exists("data/$file")) abort(404);
    return response()->json(json_decode(Storage::disk('public')->get("data/$file"), true));
});

// ------------------ AddPatients Resource ------------------
Route::resource('patients', AddPatientsController::class);
