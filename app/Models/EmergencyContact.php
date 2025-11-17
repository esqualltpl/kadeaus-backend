<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{

protected $fillable = [
    'user_id',
    'first_name',
    'last_name',
    'relation',
    'contact_number',
];
}
