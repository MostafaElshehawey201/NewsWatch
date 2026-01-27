<?php

namespace App\Services\Comment;

use DomainException;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Comment\ProcessCommentsRepository;


class ProcessCommentsService
{


    public function __construct(protected ProcessCommentsRepository $processCommentsRepository)
    {
        //
    }

    public function createComment($validationCreateCommentRequest, $post_id)
    {
        try {
            $user_id = Auth::guard('sanctum')->id();
            $comment = $this->processCommentsRepository->create($post_id, $validationCreateCommentRequest , $user_id);
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

    public function updateComment($validationCreateCommentRequest , $comment_id){
        try{
            return $this->processCommentsRepository->update($validationCreateCommentRequest , $comment_id);  
        }catch(DomainException){
            throw new DomainException(__('validation.comment.update_error'));
        }
    }

    public function deleteComment($comment_id){
        try{
            return $this->processCommentsRepository->delete($comment_id);
        }catch(DomainException){
            throw new DomainException(__('validation.comment.delete_error'));
        }
    }
}
