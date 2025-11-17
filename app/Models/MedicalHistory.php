<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    protected $fillable = [
    'user_id',
    'disease',
    'diagnosis_date',
    'status',
    'description',
    'hospital',
    'report_file',
];
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
