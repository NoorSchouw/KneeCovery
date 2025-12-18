<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PatientExerciseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FysioController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SignUpController;
use App\Http\COntrollers\ReportController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReferenceVideoController;
use App\Http\Controllers\UserExerciseController;
use App\Http\Controllers\PatientCalendarController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ExerciseExecutionController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AddPatientsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// All links for the website
//------------------------------------------------General-------------------------------------
Route::get('/', [LoginController::class, 'showLogin'])->name('login.show');

// Login POST
Route::post('/', [LoginController::class, 'login'])->name('login.perform');

// Homepage (alleen als voorbeeld)
Route::get('/homepage', function () {
    return 'Welcome to your personal homepage!';
})->middleware('auth');

Route::get('/signup', [SignUpController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [SignUpController::class, 'createUser'])->name('signup.create');

//Forgot password
// Toon het reset-scherm (GET)
Route::get('/forgot-password', [ForgotPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// Verwerk nieuw wachtwoord (POST)
Route::post('/forgot-password', [ForgotPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/', function () {
    return view('login');
})->name('login');
Route::get('/signup', function () {
    return view('signup');
});

Route::get('/privacy-policy', function () {
    return view('privacy');
});

Route::get('/contact',function () {
    return view('contact');
});

// -------------------------------------------------- Patient ---------------------------------
Route::get('/homepage', function () {
    return view('homepage');
});

//Calendar
Route::get('/calendar', function () {
    return view('patient/calendar');
});

Route::get('/calendar-data', [PatientCalendarController::class, 'getUserCalendar'])
    ->middleware('auth');

Route::get('/all-exercises', function () {
    return view('/patient/exercises');
});

// Patient report (frontend)
Route::get('/patient-report', [ReportController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/information', [InformationController::class, 'information'])->name('patient.information');
    Route::post('/information/update', [InformationController::class, 'update'])->name('patient.information.update');
});

Route::get('/filming', function () {
    return view('patient/filming');
});


// -------------------------------------------------- Physio ----------------------------------
Route::get('/patients', function () {
    return view('fysio/patients');
});

// Physio report (frontend)
Route::get('/report', function () {
    return view('physio/report');     // <-- juiste folder + bestand
})->name('physio.report');

Route::get('/patients/{user}/report', [AddPatientsController::class, 'report'])
    ->name('patients.report');

Route::get('/upload-exercises', function () {
    return view('fysio/upload_exercises');
});

Route::get('/user-exercises', [ExerciseController::class, 'getUserExercises']);
Route::post('/user-exercises/sync', [ExerciseController::class, 'sync']);
Route::get('/user-calendar', [CalendarController::class, 'getUserCalendar']);
Route::post('/calendar-exercise', [CalendarController::class, 'store']);
Route::post('/calendar-update', [CalendarController::class,'update']);
Route::post('/calendar-exercise/delete-day',[CalendarController::class,'deleteDay']);
Route::post('/calendar-exercise/delete-week',[CalendarController::class,'deleteWeek']);
Route::get('/patient/today-exercises/{userId}', [CalendarController::class, 'todayExercises']);

//Backend report
Route::get('/report/get-executions', [ReportController::class, 'getExecutions']);

// Reference storage routes
Route::post('/reference-video',[ReferenceVideoController::class,'store'])->name('reference.video');
Route::post('/reference-analysis',[ReferenceVideoController::class,'saveAnalysis'])->name('reference.analysis');
Route::get('/reference/{exercise}',[ReferenceVideoController::class,'get'])->name('reference.get');

Route::get('/user-exercises',[UserExerciseController::class,'index']);
Route::post('/user-exercises/sync',[UserExerciseController::class,'sync']);

Route::post('/exercise/store', [ExerciseExecutionController::class, 'store']);

Route::post('/exercise-executions', [ExerciseExecutionController::class, 'store']);


Route::get('/videos/{file}', function($file){
    $path = storage_path('app/public/videos/' . $file);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path, [
        'Content-Type' => 'video/mp4',
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization'
    ]);
});

Route::get('/data/{file}', function($file){
    if (!Storage::disk('public')->exists("data/$file")) abort(404);

    return response()->json(
        json_decode(Storage::disk('public')->get("data/$file"), true)
    );
});

//Filming page


Route::get('/patient/today-exercises/{user}', function($user){
    $today = date('Y-m-d');

    return DB::table('calendar_entries')
        ->join('exercise', 'calendar_entries.exercise_id', '=', 'exercise.exercise_id')
        ->where('calendar_entries.user_id', $user)
        ->whereDate('calendar_entries.date', $today)
        ->select(
            'exercise.exercise_name as exercise',
            'calendar_entries.settings',
            'calendar_entries.date'
        )
        ->get();
});

Route::get('/video/{execution}', function ($execution) {

    $exec = \App\Models\ExerciseExecution::findOrFail($execution);

    $path = storage_path('app/public/' . $exec->execution_video_path);

    return response()->file($path, [
        'Content-Type' => 'video/webm'
    ]);
});

//-----------------------------AddPatients---------------------------------------------------------

Route::resource('patients', AddPatientsController::class);

