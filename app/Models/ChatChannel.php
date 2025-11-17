<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatChannel extends Model
{
     protected $fillable = [
        'channel_name',
        'sender_id',
        'receiver_id',
        'group_id',
        'status',
        'type',
    ];

    public function Chat(){
        return $this->hasMany(Chat::class,'channel_id','id');
    }
    public function SenderUser(){
        return $this->belongsTo(User::class,'sender_id','id')->withTrashed();
    }
    public function ReceiverUser(){
        return $this->belongsTo(User::class,'receiver_id','id')->withTrashed();;
    }
}
