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

    // Mass assignment: kolommen die gevuld mogen worden via create() of fill()
    protected $fillable = [
        'phy_user_id',
        'physio_number',
        'start_date',
        'treatment_status',
        'medical_notes',
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
        return $this->belongsTo(User::class, 'user_id', 'id');
        // 'user_id' is de FK in patient
        // 'id' is de PK in user
    }

    // Een patient behoort tot één fysiotherapeut
    public function physiotherapist()
    {
        return $this->belongsTo(Physio::class, 'physio_number', 'physio_number');
        // 'physio_number' in patient verwijst naar physio_number in physiotherapist
    }
}

