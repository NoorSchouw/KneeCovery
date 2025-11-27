<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';  // belangrijk voor Auth
    public $timestamps = false;          // omdat de tabel geen created_at/updated_at heeft

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relaties
    public function patient()
    {
        return $this->hasOne(Patient::class, 'user_id', 'user_id');
    }

    public function physiotherapist()
    {
        return $this->hasOne(Physio::class, 'user_id', 'user_id');
    }
}
