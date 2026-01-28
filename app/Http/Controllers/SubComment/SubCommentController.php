<?php

namespace App\Http\Controllers\SubComment;

use Throwable;
use DomainException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\DataTransferObject\DataTransferObjectSubComment;
use Illuminate\Support\Facades\Auth;
use App\Services\SubComment\SubCommentProcessService;
use App\Http\Requests\SubComment\CreateSubCommentRequest;

class SubCommentController extends Controller
{
    public function __construct(){

    }
    public function createSubComment(CreateSubCommentRequest $createSubCommentRequest , $comment_id){
        try{
        $validation = $createSubCommentRequest->validated();
        $DTO = new DataTransferObjectSubComment([
            'content' => $validation['content'],
            'parent_comment_id' => $comment_id,
            'user_id' => Auth::guard('sanctum')->id(),
        ]);
        $SubCommentDTOInstance = app()->make(SubCommentProcessService::class)->methodCreateSubComment($DTO);
        return response()->json([
            "success" => true,
            "data" => $SubCommentDTOInstance,
            "errors"=>null,
        ],201);
        }catch(DomainException $e){
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $e->getMessage(),
            ],400);
        }catch(Throwable $e){
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => [
                    "message" => $e->getMessage(),
                    "line" => $e->getLine(),
                    "file" => $e->getFile(),
                ]
            ],500);
        }
    }
}
