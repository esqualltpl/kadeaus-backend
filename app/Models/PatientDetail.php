<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientDetail extends Model
{
    //

    protected $fillable = [
        'patient_id',
        'height',
        'weight',
        'blood_type',
        'pregnancy',
        'trimester',
    ];
}
