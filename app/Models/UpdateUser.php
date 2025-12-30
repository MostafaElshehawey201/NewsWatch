<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateUser extends Model
{
    protected $fillable = [
        "experience" , 'job_title' , 'image' , 'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
