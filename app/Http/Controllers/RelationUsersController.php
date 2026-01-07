<?php

namespace App\Http\Controllers;

use Throwable;
use DomainException;
use Illuminate\Http\Request;
use App\Http\Requests\Relation\searchUserRequest;
use App\Services\Relation\SearchUserRelationService;

class RelationUsersController extends Controller
{
    public function __construct(protected SearchUserRelationService $searchUserRelationService) {}
    public function searchUserRelation(searchUserRequest $searchUserRequest)
    {
        try {
            $validationSearchUserRequest = $searchUserRequest->validated();

            $data = $this->searchUserRelationService
                ->methodSearchUserRelationInterface($validationSearchUserRequest);

            return response()->json([
                "success" => true,
                "data" => $data,
                "errors" => null,
            ], 200);
        } catch (DomainException $e) {

            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => [
                    "message" => $e->getMessage(),
                ],
            ], 404);
        } catch (Throwable $e) {

            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => [
                    "message" => __('errors.server'),
                ],
            ], 500);
        }
    }
}
