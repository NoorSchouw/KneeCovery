<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseSchedule extends Model
{
    protected $table = 'exerciseSchedule';
    protected $primaryKey = 'schedule_id';
    public $timestamps = false;

    protected $fillable = [
        'assignment_id',
        'scheduled_date',
    ];

    public function assignment()
    {
        return $this->belongsTo(PatientExerciseAssigned::class, 'assignment_id', 'assignment_id');
    }

    public function executions()
    {
        return $this->hasMany(ExerciseExecution::class, 'schedule_id', 'schedule_id');
    }
}
