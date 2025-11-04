<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Pharmacist extends Model
{
    use SoftDeletes, HasFactory, Notifiable;

    protected $fillable = ['hospital_id', 'working_hours', 'qualification_id', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function hospitals()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function departments()
    {
        return $this->belongsTo(Department::class);
    }

    public function prescriptionReport()
    {
        return $this->hasMany(PrescriptionReport::class);
    }
}
