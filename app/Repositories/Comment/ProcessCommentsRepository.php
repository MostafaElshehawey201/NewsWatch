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
}
