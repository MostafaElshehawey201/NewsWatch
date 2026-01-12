<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Models\Attachment;
use App\Models\FavoritePost;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Post\PostCreateInterface;
use App\Interfaces\Post\AddPostToFavoriteInterface;
use App\Interfaces\Post\DeletePostInterface;
use App\Interfaces\Post\EditPostInterface;
use App\Interfaces\Post\RemovePostFavoriteInterface;
use App\Interfaces\Post\showPostsFavoriteInterface;
use DomainException;
use Exception;

class PostProcessRepository implements PostCreateInterface, AddPostToFavoriteInterface ,
 showPostsFavoriteInterface , RemovePostFavoriteInterface , EditPostInterface , DeletePostInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function methodPostCreateInterface($validationPostCreateRequest, $postCreateRequest , $category_id)
    {
        $user = Auth::user();
        $post = Post::create([
            'user_id' => $user->id,
            "title" => $validationPostCreateRequest['title'] ?? null,
            "body" => $validationPostCreateRequest['body'] ?? null,
            "category_id" => $category_id,
        ]);
        if ($postCreateRequest->hasFile('file')) {
            $catchFile = $postCreateRequest->file('file');
            $file_name = time() . '.' . $catchFile->extension();
            $file_path = $catchFile->storeAs('upload/CreatePost', $file_name, 'public');
        }
        Attachment::create([
            "file" => $file_path ?? null,
            "post_id" => $post->id,
        ]);
    }

    public function methodAddPostToFavorite($post_id)
    {
        $user_id = Auth::id();
        $FavoritePost = FavoritePost::where(function ($query) use ($user_id, $post_id) {
            $query->where('user_id', $user_id)
                ->Where('post_id', $post_id);
        })->exists();
        FavoritePost::create([
            "user_id" => $user_id,
            "post_id" => $post_id,
        ]);
        return $FavoritePost;
    }

    public function methodShowPostsFavoriteInterface(){
        $user_id = Auth::guard('sanctum')->id();
        $postsFavorite = FavoritePost::where(function($query) use ($user_id){
            $query->where('user_id' , $user_id);
        })->get();
        return $postsFavorite;
    }

    public function methodEditPostInterface($post_id){
        $editPost = Post::find($post_id);
        return $editPost;
    }

    public function methodDeletePostInterface($post_id){
        $deletePost = Post::find($post_id);
        return $deletePost;
    }

    public function methodRemovePostFavorite($post_id){
        $removePostFavorite = FavoritePost::find($post_id);
        return $removePostFavorite;
    }
}
