<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    protected $fillable = [
    'user_id',
    'vaccine_name',
    'type',
    'administered_date',
    'next_due_date',
    'hospital',
    'proof_file',
    'note',
    'status',
];
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function boosters()
{
    return $this->hasMany(VaccinationBooster::class, 'vaccination_id');
}


}
