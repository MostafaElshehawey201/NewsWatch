<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $auth_service){
        
    }
   
    public function register(AuthRequest $authRequest){
        $validateAuth = $authRequest->validated();
        try{
        $returnDataFromService = $this->auth_service->MethodRegisterInterface($validateAuth);
        return response()->json([
            "success" => true,
            "data" => $returnDataFromService,
            "errors" => null,
        ],201);
        }catch(\Exception $error){
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $error->getMessage(),
            ],422);
        }     
    }
}
