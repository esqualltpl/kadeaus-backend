<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class AllergyInformation extends Model
{
    use SoftDeletes, Notifiable,HasFactory;

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
