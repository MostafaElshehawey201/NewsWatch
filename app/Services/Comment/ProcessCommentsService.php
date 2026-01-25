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
}
