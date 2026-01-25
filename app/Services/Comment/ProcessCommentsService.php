<?php

namespace App\Services\Comment;

use App\Repositories\Comment\ProcessCommentsRepository;
use DomainException;


class ProcessCommentsService
{


    public function __construct(protected ProcessCommentsRepository $processCommentsRepository)
    {
        //
    }

    public function createComment($validationCreateCommentRequest, $post_id)
    {
        try {
            $comment = $this->processCommentsRepository->create($post_id, $validationCreateCommentRequest);
            return $comment;
        } catch (DomainException) {
            throw new DomainException(__('validation.comment.create_error'));
        }
    }

    public function editComment($comment_id){
        try{
            return $this->processCommentsRepository->find($comment_id);
        }catch(DomainException){
            throw new DomainException(__('validation.comment.not_found'));
        }
    }
}
