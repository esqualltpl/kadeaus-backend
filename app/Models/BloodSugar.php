<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodSugar extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
    'user_id',
    'value',
    'type',
    'date',
    'time',
    'sugar_status',
    'status',
];

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
