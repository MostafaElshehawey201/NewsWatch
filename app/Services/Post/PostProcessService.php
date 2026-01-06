<?php

namespace App\Services\Post;

use App\Interfaces\Post\AddPostToFavoriteInterface;
use App\Interfaces\Post\PostCreateInterface;

class PostProcessService implements PostCreateInterface , AddPostToFavoriteInterface
{
    /**
     * Create a new class instance.
     */
    public $sendDataCreatePostFromServiceToRepositoryByInterface;
    public $sendDataAddPostToFavoriteFromServiceToRepositoryByInterface;

    public function __construct(PostCreateInterface $postCreateInterface , AddPostToFavoriteInterface $addPostToFavoriteInterface)
    {
        $this->sendDataCreatePostFromServiceToRepositoryByInterface = $postCreateInterface ;
        $this->sendDataAddPostToFavoriteFromServiceToRepositoryByInterface = $addPostToFavoriteInterface;
    }

    public function methodPostCreateInterface($validationPostCreateRequest , $postCreateRequest , $category_id){
        $returnDataPostCreateFromRepository = $this->sendDataCreatePostFromServiceToRepositoryByInterface->methodPostCreateInterface($validationPostCreateRequest , $postCreateRequest , $category_id);
        $returnDataPostCreateFromRepository;
    }

    public function methodAddPostToFavorite($post_id){
        $returnDataAddPostFavorite = $this->sendDataAddPostToFavoriteFromServiceToRepositoryByInterface->methodAddPostToFavorite($post_id);
        return $returnDataAddPostFavorite ;
    }
}
