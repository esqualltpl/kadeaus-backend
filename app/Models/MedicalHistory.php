<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class MedicalHistory extends Model
{
    use SoftDeletes, HasFactory,Notifiable;
    
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
