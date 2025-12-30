<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\updateProfileRequest;
use App\Services\User\updateProfileService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(protected updateProfileService $updateProfileService) {}
    public function profile()
    {
        try {
            $user = Auth::user();
            return response()->json([
                "success" => true,
                "user" => $user,
                "errors" => null,
            ], 200);
        } catch (\Exception $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $errors->getMessage(),
            ], 422);
        }
    }
    public function editProfile($profile_id)
    {
        try {
            $profile_edit = User::where('id', $profile_id)->first();
            return response()->json([
                "success" => true,
                "user" => $profile_edit,
                "errors" => null,
            ], 200);
        } catch (\Exception $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $errors->getMessage(),
            ], 422);
        }
    }

    public function updateProfile(updateProfileRequest $updateProfileRequest)
    {
        $validationUpdateProfileRequest = $updateProfileRequest->validated();
        try {
            $returnDataProfileUpdateFromService = $this->updateProfileService->methodUpdateProfileInterface($updateProfileRequest , $updateProfileRequest);
            return response()->json([
                "success" => true,
                "update-data-user" => $returnDataProfileUpdateFromService,
                "error" => null,
            ], 200);
        } catch (\Exception $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "error" => $errors->getMessage()
            ], 422);
        }
    }
}
