<?php

namespace App\Services\Relation;

use App\Interfaces\Relation\SearchUserRelationInterface;
use DomainException;

class SearchUserRelationService implements SearchUserRelationInterface
{
    /**
     * Create a new class instance.
     */
    public $sendDataSearchUserRelationServiceToRepositoryByInterface;
    public function __construct(SearchUserRelationInterface $searchUserRelationInterface)
    {
        $this->sendDataSearchUserRelationServiceToRepositoryByInterface = $searchUserRelationInterface;
    }

    public function methodSearchUserRelationInterface($validationSearchUserRequest){
        $returnDataSearchUserRelationFromRepository = $this->sendDataSearchUserRelationServiceToRepositoryByInterface->methodSearchUserRelationInterface($validationSearchUserRequest);
        if($returnDataSearchUserRelationFromRepository->isEmpty()){
            throw new DomainException(__('validation.search.userNotFound'));
        }
        return $returnDataSearchUserRelationFromRepository;
    }
}
