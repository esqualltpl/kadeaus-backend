<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class HeartRate extends Model
{
    use SoftDeletes, Notifiable, HasFactory;
    protected $fillable = [
        'user_id',
        'bpm',
        'date',
        'time',
        'heart_rate_status',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
