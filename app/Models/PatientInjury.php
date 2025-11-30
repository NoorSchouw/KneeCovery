<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientInjury extends Model
{
    protected $table = 'patientInjury';
    public $timestamps = false;

    // composite PK — manually managed
    protected $primaryKey = ['user_id', 'phy_user_id', 'affected_area', 'physio_number'];
    public $incrementing = false;

    protected $fillable = [
        'affected_area',
        'user_id',
        'phy_user_id',
        'physio_number',
    ];

    // Injury relation
    public function injury()
    {
        return $this->belongsTo(Injury::class, 'affected_area', 'affected_area');
    }

    // Patient relation
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id', 'user_id');
    }

    // Physiotherapist composite relation
    public function physiotherapist()
    {
        return $this->belongsTo(Physio::class, 'phy_user_id', 'user_id')
            ->whereColumn('physiotherapist.physio_number', 'patientInjury.physio_number');
    }
}
