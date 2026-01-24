<?php

namespace App\Services\Post;

use App\Models\Post;
use DomainException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\Post\EditPostInterface;
use App\Interfaces\Post\DeletePostInterface;
use App\Interfaces\Post\PostCreateInterface;
use App\Interfaces\Post\UpdatePostInterface;
use App\Interfaces\Post\AddPostToFavoriteInterface;
use App\Interfaces\Post\showPostsFavoriteInterface;
use App\Interfaces\Post\RemovePostFavoriteInterface;
use App\Repositories\Post\PostProcessRepository;

class PostProcessService implements
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
    public $sendDataCreatePostFromServiceToRepositoryByInterface;
    public $sendDataAddPostToFavoriteFromServiceToRepositoryByInterface;
    public $showPostsFavorite;
    public $editPost;
    public $removePostFavorite;
    public $deletePost;
    public $updatePost;

    public function __construct(
        PostCreateInterface $postCreateInterface,
        AddPostToFavoriteInterface $addPostToFavoriteInterface,
        showPostsFavoriteInterface $showPostsFavoriteInterface,
        RemovePostFavoriteInterface $removePostFavoriteInterface,
        EditPostInterface $editPostInterface,
        DeletePostInterface $deletePostInterface,
        UpdatePostInterface $updatePostInterface,
        protected PostProcessRepository $postProcessRepository,
    ) {
        $this->sendDataCreatePostFromServiceToRepositoryByInterface = $postCreateInterface;
        $this->sendDataAddPostToFavoriteFromServiceToRepositoryByInterface = $addPostToFavoriteInterface;
        $this->showPostsFavorite = $showPostsFavoriteInterface;
        $this->removePostFavorite = $removePostFavoriteInterface;
        $this->editPost = $editPostInterface;
        $this->deletePost = $deletePostInterface;
        $this->updatePost = $updatePostInterface;
    }

    public function methodPostCreateInterface($validationPostCreateRequest, $postCreateRequest, $category_id)
    {
        $returnDataPostCreateFromRepository = $this->sendDataCreatePostFromServiceToRepositoryByInterface->methodPostCreateInterface($validationPostCreateRequest, $postCreateRequest, $category_id);
        $returnDataPostCreateFromRepository;
    }

    public function methodShowAllPostsInterface(){ 
        $posts = $this->postProcessRepository->methodShowAllPostsInterface();
        if($posts->isEmpty()){
            throw new DomainException(__('validation.posts.notFound'));
        }
        return $posts;
    }

    public function methodAddPostToFavorite($post_id)
    {
        $returnDataAddPostFavorite = $this->sendDataAddPostToFavoriteFromServiceToRepositoryByInterface->methodAddPostToFavorite($post_id);
        if ($returnDataAddPostFavorite) {
            throw new DomainException(__('validation.postFavorite.exist'));
        }
        return $returnDataAddPostFavorite;
    }


    public function methodShowPostsFavoriteInterface()
    {
        $returnFavoritePostsFromRepository = $this->showPostsFavorite->methodShowPostsFavoriteInterface();
        if ($returnFavoritePostsFromRepository->isEmpty()) {
            throw new DomainException(__('validation.postFavorite.notFound'));
        }
        return $returnFavoritePostsFromRepository;
    }

    public function methodEditPostInterface($post_id)
    {
        $returnEditPostFromRepository = $this->editPost->methodEditPostInterface($post_id);
        if (!$returnEditPostFromRepository) {
            throw new DomainException(__('validation.post.notFound'));
        }
        return $returnEditPostFromRepository;
    }

    public function methodDeletePostInterface($post_id)
    {
        $returnDataDeleteFromRepository = $this->deletePost->methodDeletePostInterface($post_id);
        if (!$returnDataDeleteFromRepository) {
            throw new DomainException(__('validation.post.notFound'));
        }
        $returnDataDeleteFromRepository->delete();
    }


    public function methodRemovePostFavorite($post_id)
    {
        $returnRemovePostFavoriteFromRepository = $this->removePostFavorite->methodRemovePostFavorite($post_id);
        if (!$returnRemovePostFavoriteFromRepository) {
            throw new DomainException(__('validation.postFavorite.notFound'));
        }
        $returnRemovePostFavoriteFromRepository->delete();
    }

    public function methodUpdatePostInterface($validationPostRequest, $updatePostRequest, $post_id)
    {
        $userId = Auth::guard('sanctum')->id();
        $post = $this->postProcessRepository->find($post_id);
        if (!$post) {
            throw new DomainException(__('validation.post.notFound'));
        }
        $this->postProcessRepository->updatePost($post, $validationPostRequest, $userId);
        $attachment = $this->postProcessRepository->Attachment($post_id);
        if ($updatePostRequest->hasFile('file')) {
            if ($attachment->file && Storage::disk('public')->exists($attachment->file)) {
                Storage::disk('public')->delete($attachment->file);
            }
            $fileCatch = $updatePostRequest->file('file');
            $fileNameExtension = time() . '.' . $fileCatch->extension();
            $path = $fileCatch->storeAs('upload/updatePost', $fileNameExtension, 'public');
            }else{
                $path = $attachment ? $attachment->file : null;
            }
            $this->postProcessRepository->UpdateOrCreateAttachment($post_id, $path);
    }
}
