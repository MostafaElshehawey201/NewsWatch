<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\createCommentRequest;
use App\Http\Requests\Comment\updateCommentRequest;
use App\Services\Comment\ProcessCommentsService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Throwable;

class CommentController extends Controller
{
    use AuthorizesRequests;
    public function __construct(protected ProcessCommentsService $processCommentsService) {}
    public function createComment(createCommentRequest $createCommentRequest, $post_id)
    {
        $validationCreateCommentRequest = $createCommentRequest->validated();
        try {
            $comment = $this->processCommentsService->createComment($validationCreateCommentRequest, $post_id);
            return response()->json([
                "success" => true,
                "data" => $comment,
                "errors" => null,
            ], 201);
        } catch (\DomainException $e) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $e->getMessage(),
            ], 422);
        } catch (Throwable $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => [
                    "message" => $errors->getMessage(),
                    "type" => get_class($errors),
                ],
            ], 500);
        }
    }
    public function editComment($comment_id)
    {
        try {
            $comment = $this->processCommentsService->editComment($comment_id);
            return response()->json([
                "success" => true,
                "data" => $comment,
                "errors" => null,
            ], 202);
        } catch (\DomainException $e) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $e->getMessage(),
            ], 422);
        } catch (Throwable $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => [
                    "message" => $errors->getMessage(),
                    "type" => get_class($errors),
                ],
            ], 500);
        }
    }

    public function updateComment(updateCommentRequest $updateCommentRequest, $comment_id)
    {
        try {
            $validationUpdateCommentRequest = $updateCommentRequest->validated();
            $comment = $this->processCommentsService->updateComment($validationUpdateCommentRequest, $comment_id);
            $this->authorize('update' , $comment);
            return response()->json([
                "success" => true,
                "data" => __('validation.comment.update_success'),
                "errors" => null,
            ], 200);
        } catch (\DomainException $e) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $e->getMessage(),
            ], 422);
        } catch (Throwable $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => [
                    "message" => $errors->getMessage(),
                    "type" => get_class($errors),
                ],
            ], 500);
        }
    }

    public function deleteComment($comment_id){
        try{
            $comment = $this->processCommentsService->deleteComment($comment_id);
            $this->authorize('delete' , $comment);
            return response()->json([
                "success" => true,
                "data" => __('validation.comment.delete_success'),
                "errors" => null,
            ], 204);
        } catch (\DomainException $e) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $e->getMessage(),
            ], 422);
        } catch (Throwable $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => [
                    "message" => $errors->getMessage(),
                    "type" => get_class($errors),
                ],
            ], 500);
        }
    }
}
