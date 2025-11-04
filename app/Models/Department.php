<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Department extends Model
{
    use SoftDeletes, HasFactory,Notifiable;

    protected $fillable = ['department_name', 'user_id', 'hospital_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hospitals()
    {
        return $this->hasMany(Hospital::class);
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
}
