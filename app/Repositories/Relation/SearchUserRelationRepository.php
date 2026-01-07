<?php

namespace App\Repositories\Relation;

use App\Models\User;
use App\Interfaces\Relation\SearchUserRelationInterface;
use Exception;

class SearchUserRelationRepository implements SearchUserRelationInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function methodSearchUserRelationInterface($validationSearchUserRequest) {
        $userSearch = User::where(function($query) use ($validationSearchUserRequest){
            $query->where('name' , 'Like' , '%' . $validationSearchUserRequest['name'] . '%');
        })->get();
        return $userSearch;
    }
}
