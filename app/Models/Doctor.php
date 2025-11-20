<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Doctor extends Model
{
    use SoftDeletes, Notifiable, HasFactory;

    protected $fillable = [
        'hospital_id',
        'department_id',
        'speciality_hours',
        'working_hours_from',
        'working_hours_to',
        'qualification_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function qualification()
    {
        return $this->hasOne(Qualification::class, 'doctor_id', 'id');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
}
