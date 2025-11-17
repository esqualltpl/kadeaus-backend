<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
     protected $fillable = [
        'channel_id',
        'sender_id',
        'receiver_id',
        'group_id',
        'message',
        'file',
        'file_type',
        'is_seen',
        'delete_for_sender',
        'delete_for_receiver',
    ];

    public function SenderUser(){
        return $this->belongsTo(User::class,'sender_id','id');
    }
    public function ReceiverUser(){
        return $this->belongsTo(User::class,'receiver_id','id');
    }

}
