<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table = 'exercise';
    protected $primaryKey = 'exercise_id';
    public $timestamps = false;

    protected $fillable = ['exercise_name','exercise_description'];

    // 1 exercise -> 1 reference video
    public function referenceVideo()
    {
        return $this->hasOne(ReferenceVideo::class, 'exercise_id', 'exercise_id');
    }

    public function calendarEntries()
    {
        return $this->hasMany(CalendarEntry::class, 'exercise_id', 'exercise_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'exercise_user', 'exercise_id', 'user_id');
    }

}
