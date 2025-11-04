<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital extends Model
{
    use SoftDeletes, Notifiable, HasFactory;

    protected $fillable = ['specialities','address','user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function departments()
    {
        return $this->belongsTo(Department::class);
    }

    public function nurses()
    {
        return $this->hasMany(Nurse::class);
    }

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }

    public function receptionist()
    {
        return $this->hasMany(Receptionist::class);
    }

    public function pharmacist()
    {
        return $this->hasMany(Pharmacist::class);
    }

    public function prescriptionReport()
    {
        return $this->hasMany(PrescriptionReport::class);
    }

    public function patient()
    {
        return $this->hasMany(Patient::class);
    }

    public function doctor()
    {
        return $this->hasMany(Doctor::class);
    }
}
