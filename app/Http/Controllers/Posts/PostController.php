<?php

namespace App\Http\Controllers\Posts;

use Exception;
use Throwable;
use App\Models\Post;
use DomainException;
use App\Models\FavoritePost;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Post\PostProcessService;
use App\Http\Requests\Post\PostCreateRequest;

class PostController extends Controller
{
    public function __construct(protected PostProcessService $postProcessService ) {}

    public function createPost(PostCreateRequest $postCreateRequest , $category_id)
    {
        $validationPostCreateRequest = $postCreateRequest->validated();
        try {
            $this->postProcessService->methodPostCreateInterface($validationPostCreateRequest, $postCreateRequest , $category_id);
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

    public function showPosts()
    {
        try {
            $posts = Post::with('attachment')->get();
            return response()->json([
                "success" => true,
                "data" => $posts,
                "errors" => null,
            ], 200);
        } catch (Throwable $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => [
                    "message" => $errors->getMessage(),
                    "type" => get_class($errors),
                ]
            ], 422);
        }
    }

    public function addPostFavorite($post_id)
    {
        try {
            $this->postProcessService->methodAddPostToFavorite($post_id);

            return response()->json([
                "success" => true,
                "data" => __('validation.post.favorite'),
                "errors" => null,
            ], 201);
        } catch (DomainException $e) {
            
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => [
                    "message" => $e->getMessage(),
                ],
            ], 409);
        } catch (Throwable $e) {

            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => __('errors.server'),
            ], 500);
        }
    }

    public function showPostsFavorite(){
        $showPostsFavoriteFromService = $this->postProcessService->methodShowPostsFavoriteInterface();
        try{
            return response()->json([
                "success" => true ,
                "data" => $showPostsFavoriteFromService,
                "errors"=>null,
            ],200);
        }catch(DomainException $e){
            return response()->json([
                "success"=> false ,
                "data" => __('validation.postFavorite.notFound'),
                "errors"=>$e->getMessage(),
            ],404);
        }catch(Throwable $e){
            return response()->json([
                "success"=> false, 
                "data"=>null,
                "errors" => $e->getMessage(),
            ],500);
        }
    }
}
