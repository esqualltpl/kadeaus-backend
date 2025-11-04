<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    use SoftDeletes, HasFactory, Notifiable;

    protected $fillable = ['patient_id', 'hospital_id','material_status', 'height', 'weight', 'blood_type', 'pregnancy', 'trimester', 'first_name', 'last_name', 'relation', 'user_id' , 'contact_number'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
