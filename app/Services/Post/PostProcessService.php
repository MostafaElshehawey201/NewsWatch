<?php

namespace App\Services\Post;

use App\Interfaces\Post\AddPostToFavoriteInterface;
use App\Interfaces\Post\DeletePostInterface;
use App\Interfaces\Post\EditPostInterface;
use App\Interfaces\Post\PostCreateInterface;
use App\Interfaces\Post\RemovePostFavoriteInterface;
use App\Interfaces\Post\showPostsFavoriteInterface;
use DomainException;

class PostProcessService implements
    PostCreateInterface,
    AddPostToFavoriteInterface,
    showPostsFavoriteInterface,
    RemovePostFavoriteInterface,
    EditPostInterface,
    DeletePostInterface
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

    public function __construct(
        PostCreateInterface $postCreateInterface,
        AddPostToFavoriteInterface $addPostToFavoriteInterface,
        showPostsFavoriteInterface $showPostsFavoriteInterface,
        RemovePostFavoriteInterface $removePostFavoriteInterface,
        EditPostInterface $editPostInterface,
        DeletePostInterface $deletePostInterface,
    ) {
        $this->sendDataCreatePostFromServiceToRepositoryByInterface = $postCreateInterface;
        $this->sendDataAddPostToFavoriteFromServiceToRepositoryByInterface = $addPostToFavoriteInterface;
        $this->showPostsFavorite = $showPostsFavoriteInterface;
        $this->removePostFavorite = $removePostFavoriteInterface;
        $this->editPost = $editPostInterface;
        $this->deletePost = $deletePostInterface;
    }

    public function methodPostCreateInterface($validationPostCreateRequest, $postCreateRequest, $category_id)
    {
        $returnDataPostCreateFromRepository = $this->sendDataCreatePostFromServiceToRepositoryByInterface->methodPostCreateInterface($validationPostCreateRequest, $postCreateRequest, $category_id);
        $returnDataPostCreateFromRepository;
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
}
