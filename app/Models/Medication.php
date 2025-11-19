<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Medication extends Model
{
  use SoftDeletes, Notifiable, HasFactory;

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
