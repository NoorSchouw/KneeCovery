<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    // Als de tabelnaam afwijkt van 'patients', kun je dit instellen
    protected $table = 'patient';

    // De primaire sleutel instellen (anders gaat Eloquent ervan uit dat het 'id' is)
    protected $primaryKey = 'user_id';

    public $incrementing = false; // Needs user_id from user table not its own increments

    // Mass assignment: kolommen die gevuld mogen worden via create() of fill()
    protected $fillable = [
        'user_id',
        'phy_user_id',
        'physio_number',
        'start_date',
        'treatment_status',
        'medical_notes',
        'phone_number',
        'date_of_birth',
        'patient_number', // new
    ];

    // Optioneel: als je datatypes wilt casten
    protected $casts = [
        'start_date' => 'date',
    ];

    // Als de tabel geen timestamps (created_at, updated_at) heeft
    public $timestamps = false;

    // Relatie: een patient behoort tot één user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedExercises()
    {
        return $this->hasMany(PatientExerciseAssigned::class, 'pat_user_id', 'user_id');
    }

    public function exercises()
    {
        return $this->belongsToMany(
            Exercise::class,
            'patientExerciseAssigned', // table name EXACTLY as in DB
            'pat_user_id',             // FK pointing to patient.user_id
            'exercise_id'              // FK pointing to exercises.id
        );
    }

    public function physiotherapist()
    {
        return $this->belongsTo(Physio::class, 'physio_number', 'physio_number');
        // 'physio_number' in patient verwijst naar physio_number in physiotherapist
    }

    public function injury()
    {
        return $this->hasOne(PatientInjury::class, 'user_id', 'user_id');
    }

}
