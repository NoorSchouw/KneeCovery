<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Injury extends Model
{
    protected $table = 'injury';
    protected $primaryKey = 'affected_area';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'affected_area',
    ];

    // Affected area belongs to many patients
    public function patientInjuries()
    {
        return $this->hasMany(PatientInjury::class, 'affected_area', 'affected_area');
    }
}
