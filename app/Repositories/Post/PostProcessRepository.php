<?php

namespace App\Repositories\Post;

use Exception;
use App\Models\Post;
use DomainException;
use App\Models\Attachment;
use App\Models\FavoritePost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\Post\EditPostInterface;
use App\Interfaces\Post\DeletePostInterface;
use App\Interfaces\Post\PostCreateInterface;
use App\Interfaces\Post\UpdatePostInterface;
use Symfony\Component\HttpKernel\HttpCache\Store;
use App\Interfaces\Post\AddPostToFavoriteInterface;
use App\Interfaces\Post\showPostsFavoriteInterface;
use App\Interfaces\Post\RemovePostFavoriteInterface;
use App\Models\Category;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostProcessRepository implements
    PostCreateInterface,
    AddPostToFavoriteInterface,
    showPostsFavoriteInterface,
    RemovePostFavoriteInterface,
    EditPostInterface,
    DeletePostInterface,
    UpdatePostInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function methodPostCreateInterface($validationPostCreateRequest, $postCreateRequest, $category_id)
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

    public function methodShowPostsFavoriteInterface()
    {
        $user_id = Auth::guard('sanctum')->id();
        $postsFavorite = FavoritePost::where(function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();
        return $postsFavorite;
    }

    public function methodEditPostInterface($post_id)
    {
        $editPost = Post::find($post_id);
        return $editPost;
    }

    public function methodDeletePostInterface($post_id)
    {
        $deletePost = Post::find($post_id);
        return $deletePost;
    }

    public function methodRemovePostFavorite($post_id)
    {
        $removePostFavorite = FavoritePost::find($post_id);
        return $removePostFavorite;
    }
    public function methodUpdatePostInterface($validationPostRequest, $updatePostRequest, $post_id)
    {
        // $post = Post::find($post_id);
        // if (!$post) {
        //     throw new DomainException(__('validation.post.notFound'));
        // }
        // if ($updatePostRequest->hasFile('file')) {
        //     if ($post->file && Storage::disk('public')->exists($post->file)) {
        //         Storage::disk('public')->delete($post->file);
        //     }
        //     $fileCatch = $updatePostRequest->file('file');
        //     $fileNameExtension = time() . '.' . $fileCatch->extension();
        //     $path = $fileCatch->storeAs('upload/update_post', $fileNameExtension, 'public');
        // }
        // $post->update([
        //     'user_id' => Auth::guard('sanctum')->id(),
        //     'category_id' => $post->category_id,
        //     "title" => $validationPostRequest['title'] ?? $post->title,
        //     "body" => $validationPostRequest['body'] ?? $post->body,
        // ]);
        // $data = [];
        // if (!empty($data)) {
        //     Attachment::updateOrCreate(
        //         ['post_id' => $post->id],
        //         $data
        //     );
        // }
        // return $post;

    }
    public function find($post_id){
        return Post::find($post_id);
    }
    public function updatePost($post , $validationPostRequest , $userId ){
        $post->update([
            "user_id" => $userId,
            "category_id" => $post->category_id,
            "title" => $validationPostRequest['title'] ?? $post->title,
            "body" => $validationPostRequest['body'] ?? $post->body,
        ]);
    }
    public function Attachment($post_id){
        $Attachment = Attachment::where('post_id' , $post_id)->first();
        return $Attachment;
    }
    public function UpdateOrCreateAttachment($post_id , $path ){
        Attachment::updateOrCreate(
            ["post_id" => $post_id ],
            ["file" => $path],
        );
    }
}
