<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoritePost extends Model
{
    protected $fillable = [
        "user_id" , 'post_id'
    ];

    public function user(){
        return $this->belongsToMany(User::class , 'user_id' , 'id');
    }

    public function post(){
        return $this->belongsToMany(Post::class , 'post_id' , 'id');
    }
}
