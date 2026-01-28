<?php

namespace App\Services\SubComment;

use App\Repositories\SubComment\SubCommentProcessRepository;
use DomainException;

class SubCommentProcessService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected SubCommentProcessRepository $sub_comment_process_repository)
    {
        //
    }

    public function methodCreateSubComment($DTO)
    {
        if ($DTO->parent_comment_id <= 0) {
            throw new DomainException(__('validation.comment_id.negative'));
        }
        $comment_id = $DTO->parent_comment_id;
        $this->sub_comment_process_repository->findOrFail($comment_id);
        if ($DTO->content == null && $DTO->content == '') {
            throw new DomainException(__('validation.subComment.content.empty'));
        }
        if ($DTO->parent_comment_id && $DTO->user_id && $DTO->content) {
            return $this->sub_comment_process_repository->create($DTO);
        }
    }

    public function methodEditSubComment($subComment_id)
    {
        return $this->sub_comment_process_repository->findOrFailSubComment($subComment_id);
    }

    public function methodUpdateSubComment($DTO)
    {
        if ($DTO->subComment_id <= 0) {
            throw new DomainException(__('validation.SubComment_id.negative'));
        }
        $subComment_id = $DTO->subComment_id;
        $this->sub_comment_process_repository->findOrFailUpdateSubComment($subComment_id);
        if ($DTO->content != null && $DTO->content != '') {
            return $this->sub_comment_process_repository->update($DTO, $subComment_id);
        } else {
            throw new DomainException(__('validation.subComment.content.empty'));
        }
    }
}
