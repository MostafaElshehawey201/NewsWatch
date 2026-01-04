<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        "user_id" , "file"
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
