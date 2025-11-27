<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Physio extends Model
{
    use HasFactory;

    protected $table = 'physiotherapist';

    // Laravel ondersteunt geen composite keys standaard, dus we laten $primaryKey weg
    public $incrementing = false; // Omdat er geen auto-increment kolom is
    public $timestamps = false; // Geen created_at / updated_at kolommen

    protected $fillable = [
        'user_id',
        'physio_number',
    ];

    // Relatie: een physiotherapist behoort tot één user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Een fysiotherapeut kan meerdere patiënten hebben
    public function patients()
    {
        return $this->hasMany(Patient::class, 'physio_number', 'physio_number');
    }
}
