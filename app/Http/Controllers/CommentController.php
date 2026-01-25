<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\createCommentRequest;
use App\Services\Comment\ProcessCommentsService;
use Illuminate\Http\Request;
use Throwable;

class CommentController extends Controller
{
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
}
