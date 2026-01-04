<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostCreateRequest;
use App\Services\Post\PostProcessService;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class PostController extends Controller
{
    public function __construct(protected PostProcessService $postProcessService) {}
    public function createPost(PostCreateRequest $postCreateRequest)
    {
        $validationPostCreateRequest = $postCreateRequest->validated();
        try {
            $this->postProcessService->methodPostCreateInterface($validationPostCreateRequest, $postCreateRequest);
            return response()->json([
                "success" => true,
                "data" => __('validation.post.create'),
                "errors" => null,
            ], 201);
        } catch (Throwable $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => [
                    "message" => $errors->getMessage(),
                    "type" => get_class($errors),
                ],
            ], 422);
        }
    }
}
