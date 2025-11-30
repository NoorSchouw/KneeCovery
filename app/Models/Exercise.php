<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table = 'exercise';
    protected $primaryKey = 'exercise_id';
    public $timestamps = false;

    protected $fillable = [
        'exercise_name',
        'exercise_description',
        'exercise_video_path',
    ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patientExerciseAssigned');
    }

    public function assignments()
    {
        return $this->hasMany(PatientExerciseAssigned::class, 'exercise_id', 'exercise_id');
    }
}
