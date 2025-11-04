<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use PhpParser\Builder\Function_;

class PrescriptionReport extends Model
{
    use SoftDeletes, HasFactory, Notifiable;

    protected $fillable = ['patient_id', 'appointment_id', 'attachment', 'pharmacist_id', 'hospital_id', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function patients()
    {
        return $this->belongsTo(Patient::class);
    }

    // public function appointments()
    // {
    //     return $this->belongsTo(Appointment::class);
    // }

    public function pharmacists()
    {
        return $this->belongsTo(Pharmacist::class);
    }

    public function hospitals()
    {
        return $this->belongsTo(Hospital::class);
    }
}
