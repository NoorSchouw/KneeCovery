<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';  // belangrijk voor Auth
    public $timestamps = false;          // omdat de tabel geen created_at/updated_at heeft

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
//        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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


public function exercises()
{
    // pivot: exercise_user (user_id, exercise_id)
    return $this->belongsToMany(
        Exercise::class,
        'exercise_user',
        'user_id',
        'exercise_id'
    )->withTimestamps();
}

public function calendarEntries()
{
    return $this->hasMany(CalendarEntry::class, 'user_id', 'user_id');
}

}

