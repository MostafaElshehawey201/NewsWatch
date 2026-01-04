<?php

namespace App\Services\Post;

use App\Interfaces\Post\PostCreateInterface;

class PostProcessService implements PostCreateInterface
{
    /**
     * Create a new class instance.
     */
    public $sendDataCreatePostFromServiceToRepositoryByInterface;
    public function __construct(PostCreateInterface $postCreateInterface)
    {
        $this->sendDataCreatePostFromServiceToRepositoryByInterface = $postCreateInterface ;
    }

    public function methodPostCreateInterface($validationPostCreateRequest , $postCreateRequest){
        $returnDataPostCreateFromRepository = $this->sendDataCreatePostFromServiceToRepositoryByInterface->methodPostCreateInterface($validationPostCreateRequest , $postCreateRequest);
        $returnDataPostCreateFromRepository;
    }
}
