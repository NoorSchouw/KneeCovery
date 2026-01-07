<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseExecution extends Model
{
    protected $table = 'excerciseExecution';
    protected $primaryKey = 'execution_id';
    public $timestamps = false; // laten staan
    protected $fillable = [
        'calendar_entry_id',
        'execution_date',
        'feedback',
        'score',
        'match_percentage',
        'min_angle',
        'max_angle',
        'start_time',
        'end_time',
        'duration',
        'execution_video_path',
    ];




    public function calendarEntry()
    {
        return $this->belongsTo(CalendarEntry::class, 'calendar_entry_id', 'id');

    }


    public function assignment()
    {
        return $this->belongsTo(PatientExerciseAssigned::class, 'assignment_id', 'assignment_id');
    }
}
