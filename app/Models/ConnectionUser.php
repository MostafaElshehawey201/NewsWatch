<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectionUser extends Model
{
    protected $fillable = [
        "connection_status" , 'requester_user_id' , 'receiver_user_id',
    ];

    public function requestUser(){
        return $this->belongsTo(user::class , 'requester_user_id' , 'id');
    }
    public function receiverUser(){
        return $this->belongsTo(User::class ,'receiver_user_id' , 'id');
    }
}
