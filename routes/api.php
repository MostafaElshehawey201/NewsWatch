<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

    Route::middleware('api')->prefix('auth')->group(function (){
        Route::post("register" , [AuthController::class , 'register'])->middleware('setApiLocalLang');
        Route::post('login' , [AuthController::class , 'login'])->middleware('setApiLocalLang');
        Route::post("forget-password" , [AuthController::class , 'forgetPassword'])->middleware('setApiLocalLang');
        Route::post('check-otp' , [AuthController::class , 'checkOtp'])->middleware('setApiLocalLang');
        Route::post('reset-password' , [AuthController::class , 'resetPassword'])->middleware(['auth:sanctum' , 'setApiLocalLang']);
    });
    Route::middleware('api')->prefix('user')->group(function(){
        Route::get('profile' , [UserController::class , 'profile'])->middleware(['auth:sanctum' , 'setApiLocalLang']);
        Route::get('edit-profile/{profile_id}' , [UserController::class , 'editProfile'])->middleware(['auth:sanctum' , 'setApiLocalLang']);
        Route::post('update-profile/{profile_id}' , [UserController::class , 'updateProfile'])->middleware(['auth:sanctum' , 'setApiLocalLang']);
    })
?>