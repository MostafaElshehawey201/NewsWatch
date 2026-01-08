<?php

namespace App\Services\Post;

use App\Interfaces\Post\AddPostToFavoriteInterface;
use App\Interfaces\Post\PostCreateInterface;
use App\Interfaces\Post\showPostsFavoriteInterface;
use DomainException;

class PostProcessService implements PostCreateInterface , AddPostToFavoriteInterface , showPostsFavoriteInterface
{
    /**
     * Create a new class instance.
     */
    public $sendDataCreatePostFromServiceToRepositoryByInterface;
    public $sendDataAddPostToFavoriteFromServiceToRepositoryByInterface;
    public $showPostsFavorite;

    public function __construct(PostCreateInterface $postCreateInterface , AddPostToFavoriteInterface $addPostToFavoriteInterface
    ,showPostsFavoriteInterface $showPostsFavoriteInterface)
    {
        $this->sendDataCreatePostFromServiceToRepositoryByInterface = $postCreateInterface ;
        $this->sendDataAddPostToFavoriteFromServiceToRepositoryByInterface = $addPostToFavoriteInterface;
        $this->showPostsFavorite = $showPostsFavoriteInterface;
    }

    public function methodPostCreateInterface($validationPostCreateRequest , $postCreateRequest , $category_id){
        $returnDataPostCreateFromRepository = $this->sendDataCreatePostFromServiceToRepositoryByInterface->methodPostCreateInterface($validationPostCreateRequest , $postCreateRequest , $category_id);
        $returnDataPostCreateFromRepository;
    }

    public function methodAddPostToFavorite($post_id){
        $returnDataAddPostFavorite = $this->sendDataAddPostToFavoriteFromServiceToRepositoryByInterface->methodAddPostToFavorite($post_id);
        return $returnDataAddPostFavorite ;
    }

    public function methodShowPostsFavoriteInterface(){
        $returnFavoritePostsFromRepository = $this->showPostsFavorite->methodShowPostsFavoriteInterface();
        if($returnFavoritePostsFromRepository->isEmpty()){
            throw new DomainException(__('validation.postFavorite.notFound'));
        }
        return $returnFavoritePostsFromRepository;
    }
}

