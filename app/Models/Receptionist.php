<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Receptionist extends Model
{
    use SoftDeletes, HasFactory, Notifiable;

    protected $fillable = ['role_id', 'hospital_id', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    // public function role()
    // {
    //     return $this->belongsTo();
    // }

    public function hospitals()
    {
        return $this->belongsTo(Hospital::class);
    }
}
