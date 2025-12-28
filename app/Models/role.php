<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected  $fillable = [
        "role_user" , 'user_id'
    ];

    public function user(){
        return $this->belongsTo((User::class));
    }
}
