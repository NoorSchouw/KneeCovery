<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress';
    protected $primaryKey = 'progress_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'metric_name',
        'metric_value',
        'recorded_at',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id', 'user_id');
    }
}
