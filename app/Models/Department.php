<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Department extends Model
{
    use SoftDeletes, HasFactory,Notifiable;

    protected $fillable = ['name', 'user_id', 'hospital_id', 'nurse_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function nurses()
    {
        return $this->hasMany(Nurse::class);
    }

    public function pharmacist()
    {
        return $this->hasMany(Pharmacist::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'department_id');
    }
}
