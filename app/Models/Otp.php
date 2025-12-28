<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        "otp" , 'is_used' , 'expires_at' , 'user_id'
    ];

    protected $hidden = [
        "otp"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
