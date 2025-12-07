<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEntry extends Model
{
    protected $fillable = ['user_id','exercise_id','date','settings'];

    protected $casts = [
        'settings'=>'array',
        'date'=>'date:Y-m-d'
    ];

    public function exercise(){
        return $this->belongsTo(Exercise::class,'exercise_id','exercise_id');
    }
}
