<?php

namespace App\Repositories\Comment;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ProcessCommentsRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create($post_id, $validationCreateCommentRequest)
    {
        $post = Post::find($post_id);
        $user_id = Auth::guard('sanctum')->id();
        return Comment::create([
            'post_id' => $post->id,
            'user_id' => $user_id,
            'comment' => $validationCreateCommentRequest['content']
        ]);
    }

    public function find($comment_id){
        return Comment::find($comment_id);
    }

    public function update($validationCreateCommentRequest , $comment_id){
        $comment = Comment::find($comment_id);
        $comment->update([
            'comment' => $validationCreateCommentRequest['content']
        ]);
        return true;
    }

    public function delete($comment_id){
        $comment = Comment::find($comment_id);
        $comment->delete();
        return true;
    }
}
