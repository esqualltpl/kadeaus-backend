<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
    'user_id',
    'date',
    'time',
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

}
