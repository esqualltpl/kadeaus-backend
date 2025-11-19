<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class BloodPressure extends Model
{
    use SoftDeletes, HasFactory, Notifiable;
    
    protected $fillable = [
        'user_id',
        'systolic',
        'diastolic',
        'date',
        'time',
        'blood_pressure_status',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
