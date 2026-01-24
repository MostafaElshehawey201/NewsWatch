<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "title" , 'body' , 'user_id' , 'category_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function attachment(){
        return $this->hasMany(Attachment::class);
    }

    public function FavoritePost(){
        return $this->hasMany(FavoritePost::class , 'post_id' , 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class , 'post_id' , 'id');
    }
}
