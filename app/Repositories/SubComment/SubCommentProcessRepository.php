<?php

namespace App\Repositories\SubComment;

use App\Models\Comment;
use App\Models\SubComment;

class SubCommentProcessRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function findOrFail($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        return $comment;
    }
    public function create($DTO)
    {
        return SubComment::create([
            'parent_comment_id' => $DTO->parent_comment_id,
            "user_id" => $DTO->user_id,
            "content" => $DTO->content,
        ]);
    }

    public function findOrFailSubComment($subComment_id){
        return SubComment::findOrFail($subComment_id);
    }
}
