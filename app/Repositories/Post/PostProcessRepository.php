<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Post\PostCreateInterface;

class PostProcessRepository implements PostCreateInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function methodPostCreateInterface($validationPostCreateRequest, $postCreateRequest)
    {
            $user = Auth::user();
            $post = Post::create([
                'user_id' => $user->id,
                "title" => $validationPostCreateRequest['title'] ?? null,
                "body" => $validationPostCreateRequest['body'] ?? null,
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
}
