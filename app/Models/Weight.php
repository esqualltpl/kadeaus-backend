<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
           protected $fillable = [
    'user_id',
    'weight',
    'date',
    'time',
    'status',
];

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
