<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenceVideo extends Model
{
    protected $table = 'reference_videos';

    protected $fillable = [
        'exercise_id',
        'video_path',
        'video_url',
        'payload'
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    protected $appends = ['video_url'];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class,'exercise_id','exercise_id');
    }

    public function getVideoUrlAttribute()
    {
        if ($this->video_path) {
            return url('/videos/' . basename($this->video_path));
        }
        return $this->video_url;
    }
}
