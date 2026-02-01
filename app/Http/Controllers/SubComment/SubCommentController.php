<?php

namespace App\Http\Controllers\SubComment;

use Throwable;
use DomainException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\SubComment\SubCommentProcessService;
use App\Http\Requests\SubComment\CreateSubCommentRequest;
use App\Http\Requests\SubComment\UpdateSubCommentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\DataTransferObject\DataTransferObjectSubComment;
use App\Http\Resources\CommentResource\EditSubCommentResource;
use App\Http\Resources\CommentResource\CreateSubCommentResource;
use App\Http\Resources\CommentResource\DeleteSubCommentResource;
use App\Http\Resources\CommentResource\UpdateSubCommentResource;
use App\Http\DataTransferObject\DataTransferObjectSubCommentUpdate;

class SubCommentController extends Controller
{
    use AuthorizesRequests;
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

    public function editSubComment($subComment_id){
        $SubCommentEdit = $this->subCommentProcessService->methodEditSubComment($subComment_id);
        return EditSubCommentResource::make($SubCommentEdit);
    }

    public function updateSubComment(UpdateSubCommentRequest $updateSubCommentRequest , $subComment_id){
        $validation = $updateSubCommentRequest->validated();
        $DTO = new DataTransferObjectSubCommentUpdate([
            'content' => $validation['content'],
            'subComment_id' => $subComment_id,
            'user_id' => Auth::guard('sanctum')->id(),
        ]);
        $subComment =$this->subCommentProcessService->methodEditSubComment($subComment_id);
        $this->authorize('update' , $subComment);
        $update = $this->subCommentProcessService->methodUpdateSubComment($DTO);
        return UpdateSubCommentResource::make($update);
        
    }

    public function deleteSubComment($subComment_id){
        $subComment = $this->subCommentProcessService->methodEditSubComment($subComment_id);
        $this->authorize('delete' , $subComment);
        $delete = $this->subCommentProcessService->methodDeleteSubComment($subComment_id);
        return DeleteSubCommentResource::make($delete);
    }
}