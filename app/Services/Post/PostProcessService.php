<?php

namespace App\Services\Post;

use App\Interfaces\Post\AddPostToFavoriteInterface;
use App\Interfaces\Post\PostCreateInterface;
use App\Interfaces\Post\RemovePostFavoriteInterface;
use App\Interfaces\Post\showPostsFavoriteInterface;
use DomainException;

class PostProcessService implements
    PostCreateInterface,
    AddPostToFavoriteInterface,
    showPostsFavoriteInterface,
    RemovePostFavoriteInterface
{
    /**
     * Create a new class instance.
     */
    public $sendDataCreatePostFromServiceToRepositoryByInterface;
    public $sendDataAddPostToFavoriteFromServiceToRepositoryByInterface;
    public $showPostsFavorite;

    public $removePostFavorite;

    public function __construct(
        PostCreateInterface $postCreateInterface,
        AddPostToFavoriteInterface $addPostToFavoriteInterface,
        showPostsFavoriteInterface $showPostsFavoriteInterface,
        RemovePostFavoriteInterface $removePostFavoriteInterface
    ) {
        $this->sendDataCreatePostFromServiceToRepositoryByInterface = $postCreateInterface;
        $this->sendDataAddPostToFavoriteFromServiceToRepositoryByInterface = $addPostToFavoriteInterface;
        $this->showPostsFavorite = $showPostsFavoriteInterface;
        $this->removePostFavorite = $removePostFavoriteInterface;
    }

    public function methodPostCreateInterface($validationPostCreateRequest, $postCreateRequest, $category_id)
    {
        $returnDataPostCreateFromRepository = $this->sendDataCreatePostFromServiceToRepositoryByInterface->methodPostCreateInterface($validationPostCreateRequest, $postCreateRequest, $category_id);
        $returnDataPostCreateFromRepository;
    }

    public function methodAddPostToFavorite($post_id)
    {
        $returnDataAddPostFavorite = $this->sendDataAddPostToFavoriteFromServiceToRepositoryByInterface->methodAddPostToFavorite($post_id);
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

    public function methodRemovePostFavorite($post_id)
    {
        $returnRemovePostFavoriteFromRepository = $this->removePostFavorite->methodRemovePostFavorite($post_id);
        if (!$returnRemovePostFavoriteFromRepository) {
            throw new DomainException(__('validation.postFavorite.notFound'));
        }
        if ($returnRemovePostFavoriteFromRepository) {
            $returnRemovePostFavoriteFromRepository->delete();
            return true;
        }
    }
}
