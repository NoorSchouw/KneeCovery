<?php

use App\Http\Controllers\AddPatientsController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PatientCalendarController;
use App\Http\Controllers\PatientExerciseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportPhysioController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReferenceVideoController;
use App\Http\Controllers\UserExerciseController;
use App\Http\Controllers\ExerciseExecutionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

//------------------------------------------------General-------------------------------------
// Login
Route::get('/', [LoginController::class, 'showLogin'])->name('login.show');
Route::post('/', [LoginController::class, 'login'])->name('login.perform');

// Homepage (alleen als voorbeeld)
Route::get('/homepage', function () {
    return 'Welcome to your personal homepage!';
})->middleware('auth');

Route::get('/signup', [SignUpController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [SignUpController::class, 'createUser'])->name('signup.create');

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/signup', function () {
    return view('signup');
});
Route::get('/forgot-password', function () {
    return view('forgot_password');
});
Route::get('/privacy-policy', function () {
    return view('privacy');
});

// Contact
Route::get('/contact', function () {
    return view('contact');
});

//-------------------------------------------------- Patient -------------------------------
// Homepage
Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

Route::get(
    '/homepage/calendar/{date}',
    [HomepageController::class, 'calendarByDate']
);
Route::get('/homepage/progress', [HomepageController::class, 'progress']);
Route::get('/homepage/knee-metrics', [HomepageController::class, 'kneeMetrics']);

// Alle exercises pagina
Route::middleware(['auth'])->group(function () {
    Route::get('/all-exercises', [PatientExerciseController::class, 'index'])->name('patient.exercises');
});

// Patient calendar
Route::get('/calendar', function () {
    return view('patient/calendar');
});
Route::get('/api/calendar', [PatientCalendarController::class, 'getUserCalendar']);

Route::get('/calendar-data', [PatientCalendarController::class, 'getUserCalendar'])
    ->middleware('auth');

// Report
Route::get('/patient-report', [ReportController::class, 'index'])
    ->name('patient.report');
Route::get('/report/execution/by-id/{executionId}', [ReportController::class, 'executionById']);


// Patient informatie
Route::middleware(['auth'])->group(function () {
    Route::get('/information', [InformationController::class, 'information'])->name('patient.information');
    Route::post('/information/update', [InformationController::class, 'update'])->name('patient.information.update');
});

Route::get('/filming', function () { return view('patient/filming'); })->name('filming.show');

//----------------------------------------------------Physio----------------------------------
//Patients list
Route::get('/patients/{user}/report', [AddPatientsController::class, 'report'])
    ->name('patients.report');
Route::resource('patients', AddPatientsController::class);

// Report
Route::get('/report', [ReportPhysioController::class, 'index'])->name('fysio.report');
Route::get('/report/execution/by-id/{executionId}', [ReportPhysioController::class, 'executionById']);

Route::get('/upload-exercises', function () {
    return view('/fysio/upload_exercises');
});
//----------------------------------------------------User/Calendar----------------------------------
Route::get('/user-exercises', [ExerciseController::class, 'getUserExercises']);
Route::post('/user-exercises/sync', [ExerciseController::class, 'sync']);

Route::get('/user-calendar', [CalendarController::class, 'getUserCalendar']);
Route::post('/calendar-exercise', [CalendarController::class, 'store']);
Route::post('/calendar-update', [CalendarController::class,'update']);
Route::post('/calendar-exercise/delete-day',[CalendarController::class,'deleteDay']);
Route::post('/calendar-exercise/delete-week',[CalendarController::class,'deleteWeek']);

// THIS IS THE KEY: return `id` so frontend knows `calendar_entry_id`
Route::get('/patient/today-exercises/{user}', function($user){
    $today = date('Y-m-d');

    return DB::table('calendar_entries')
        ->join('exercise', 'calendar_entries.exercise_id', '=', 'exercise.exercise_id')
        ->where('calendar_entries.user_id', $user)
        ->whereDate('calendar_entries.date', $today)
        ->select(
            'calendar_entries.id',        // 👈 MUST RETURN THIS
            'exercise.exercise_name as exercise',
            'calendar_entries.settings',
            'calendar_entries.date'
        )
        ->get();
});

//----------------------------------------------------Reference----------------------------------
Route::post('/reference-video', [ReferenceVideoController::class,'store'])->name('reference.video');
Route::post('/reference-analysis', [ReferenceVideoController::class,'saveAnalysis'])->name('reference.analysis');
Route::get('/reference/{exercise}', [ReferenceVideoController::class,'get'])->name('reference.get');

//----------------------------------------------------Exercise Executions----------------------------------
Route::post('/exercise/store', [ExerciseExecutionController::class,'store']);
Route::post('/exercise-executions', [ExerciseExecutionController::class,'store']);

//----------------------------------------------------Videos----------------------------------
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

Route::get('/video/{execution}', function ($execution) {
    $exec = \App\Models\ExerciseExecution::findOrFail($execution);
    $path = storage_path('app/public/' . $exec->execution_video_path);
    return response()->file($path, ['Content-Type' => 'video/webm']);
});

Route::get('/data/{file}', function($file){
    if (!Storage::disk('public')->exists("data/$file")) abort(404);
    return response()->json(json_decode(Storage::disk('public')->get("data/$file"), true));
});
