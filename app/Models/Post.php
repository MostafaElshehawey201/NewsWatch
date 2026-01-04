<?php

namespace App\Models;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "title" , 'body' , 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function attachment(){
        return $this->hasMany(Attachment::class);
    }
}
