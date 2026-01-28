<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class SubComment extends Model
{
    protected $fillable = [
        "parent_comment_id" , "user_id" , "content",
    ];

    public function parentComment(){
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
