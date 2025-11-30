<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseExecution extends Model
{
    protected $table = 'excerciseExecution';
    protected $primaryKey = ['schedule_id', 'execution_id']; // composite key (manual)
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'schedule_id',
        'execution_id',
        'assignment_id',
        'execution_date',
        'feedback',
        'score',
        'start_time',
        'end_time',
        'duration',
        'execution_video_path',
    ];

    public function schedule()
    {
        return $this->belongsTo(ExerciseSchedule::class, 'schedule_id', 'schedule_id');
    }

    public function assignment()
    {
        return $this->belongsTo(PatientExerciseAssigned::class, 'assignment_id', 'assignment_id');
    }
}
