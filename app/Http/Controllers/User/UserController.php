<?php

namespace App\Http\Controllers\User;

use App\Models\City;
use App\Models\User;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\User\updateProfileService;
use App\Http\Requests\User\updateProfileRequest;
use DomainException;
use Throwable;

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

    public function governorate(){
        try{
            $governorates = Governorate::all();
            return response()->json([
                "success" => true ,
                "data" => $governorates,
                "errors" => null,
            ],200);
        }catch(\Exception $errors){
            return response()->json([
                "success" => false,
                "data" => null ,
                "errors" => $errors->getMessage(),
            ],422);
        }
    }

    public function city(){
        try{
            $cities = City::all();
            return response()->json([
                "success" => true ,
                "data" => $cities,
                "errors" => null,
            ],200);
        }catch(\Exception $errors){
            return response()->json([
                "success" => false,
                "data" => null ,
                "errors" => $errors->getMessage(),
            ],422);
        }
    }
    public function updateProfile(updateProfileRequest $updateProfileRequest , $profile_id)
    {
        $validationUpdateProfileRequest = $updateProfileRequest->validated();
        try {
            $returnDataProfileUpdateFromService = $this->updateProfileService->methodUpdateProfileInterface($validationUpdateProfileRequest , $updateProfileRequest , $profile_id);
            return response()->json([
                "success" => true,
                "update-data-user" => $returnDataProfileUpdateFromService,
                "error" => null,
            ], 201);
        } catch (\Exception $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $errors->getMessage()
            ], 422);
        }
    }

    public function logout(Request $request){
        try{
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                "success" => true,
                "message" => __('logout.logout'),
                "errors"=> null,
            ],200);
        }catch(\Exception $errors){
            return response()->json([
                "success"=>false,
                "errors" => $errors->getMessage(),
            ],422);
        }
    }

    public function logoutAll(Request $request){
       try{
        $this->updateProfileService->logoutAll($request);
        return response()->json([
            "success"=> true,
            "data" => null,
            "message" => __('validation.user.logoutAll'),
            "errors" => null,
        ],200);
       }catch(DomainException $e){
            return response()->json([
                "success" => false,
                "data" => null,
                "errors"=> $e->getMessage(),
            ],401);
       }catch(Throwable $e){
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" =>$e->getMessage(),
            ],500);
       }
    }
}
