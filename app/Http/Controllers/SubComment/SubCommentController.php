<?php

namespace App\Http\Controllers\SubComment;

use Throwable;
use DomainException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\SubComment\SubCommentProcessService;
use App\Http\Requests\SubComment\CreateSubCommentRequest;
use App\Http\DataTransferObject\DataTransferObjectSubComment;
use App\Http\Resources\CommentResource\EditSubCommentResource;
use App\Http\Resources\CommentResource\CreateSubCommentResource;

class SubCommentController extends Controller
{
    public function __construct(protected SubCommentProcessService $subCommentProcessService){

    }
    public function createSubComment(CreateSubCommentRequest $createSubCommentRequest , $comment_id){
        $validation = $createSubCommentRequest->validated();
        $DTO = new DataTransferObjectSubComment([
            'content' => $validation['content'],
            'parent_comment_id' => $comment_id,
            'user_id' => Auth::guard('sanctum')->id(),
        ]);
        $SubCommentDTOInstance = app()->make(SubCommentProcessService::class)->methodCreateSubComment($DTO);
        return CreateSubCommentResource::make($SubCommentDTOInstance);
    }

    public function editSubCommentController($subComment_id){
        $SubCommentEdit = $this->subCommentProcessService->methodEditSubComment($subComment_id);
        return EditSubCommentResource::make($SubCommentEdit);
    }
}