<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllergyInformation extends Model
{
    protected $fillable = [
    'user_id',
    'type',
    'allergy_name',
    'reaction_type',
    'severity',
    'identify_date',
    'note',
    'status',
];
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
