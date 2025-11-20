<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use SoftDeletes, Notifiable, HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'time',
        'description',
        'created_by',
        'rescheduled_by',
        'rescheduled_date',
        'cancelled_by',
        'cancelled_date',
        'hospital_id',
        'department_id',
        'doctor_id',
        'is_share_documents',
        'visit_type',
        'virtual_link',
        'note',
        'cancel_reason',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
