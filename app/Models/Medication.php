<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
  protected $fillable = [
    'user_id',
    'medication_name',
    'dosage',
    'frequency',
    'start_date',
    'end_date',
    'duration',
    'reason',
    'is_taking',
    'status',
];
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
