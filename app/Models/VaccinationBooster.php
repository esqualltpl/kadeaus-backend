<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaccinationBooster extends Model
{
protected $fillable = [
    'user_id',
    'vaccination_id',
    'name',
    'due_date',
    'status',
];
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function vaccination()
{
    return $this->belongsTo(Vaccination::class, 'vaccination_id');
}
}
