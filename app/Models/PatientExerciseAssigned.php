<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientExerciseAssigned extends Model
{
    protected $table = 'patientExerciseAssigned';
    protected $primaryKey = 'assignment_id';
    public $timestamps = false;

    protected $fillable = [
        'exercise_id',
        'user_id',
        'physio_number',
        'pat_user_id',
        'frequency',
        'frequency_period',
        'assigned_date',
        'personal_video_path',
    ];

    // Relation: belongs to Exercise
    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id', 'exercise_id');
    }

    // Relation: belongs to Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'pat_user_id', 'user_id');
    }

    // Relation: belongs to Physiotherapist
    public function physiotherapist()
    {
        return $this->belongsTo(Physio::class, 'user_id', 'user_id')
            ->whereColumn('physio_number', 'physiotherapist.physio_number');
    }

    // Relation: has many Schedules
    public function schedules()
    {
        return $this->hasMany(ExerciseSchedule::class, 'assignment_id', 'assignment_id');
    }

    // Relation: has many Executions
    public function executions()
    {
        return $this->hasMany(ExerciseExecution::class, 'assignment_id', 'assignment_id');
    }
}
