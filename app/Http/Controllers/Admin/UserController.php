<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(){
        try{
        $user = Auth::user();
        return response()->json([
            "success" => true,
            "user" => $user,
            "errors" => null,
        ],200);
        }catch(\Exception $errors){
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $errors->getMessage(),
            ],422);
        }     
    }
}
