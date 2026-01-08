<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\RelationUsersController;

    Route::middleware('api')->prefix('auth')->group(function (){
        Route::post("register" , [AuthController::class , 'register'])->middleware('setApiLocalLang');
        Route::post('login' , [AuthController::class , 'login'])->middleware('setApiLocalLang');
        Route::post("forget-password" , [AuthController::class , 'forgetPassword'])->middleware('setApiLocalLang');
        Route::post('check-otp' , [AuthController::class , 'checkOtp'])->middleware('setApiLocalLang');
        Route::post('reset-password' , [AuthController::class , 'resetPassword'])->middleware(['auth:sanctum' , 'setApiLocalLang']);
    });
    Route::middleware('api')->prefix('user')->group(function(){
        Route::get('profile' , [UserController::class , 'profile'])->middleware(['auth:sanctum' , 'setApiLocalLang']);
        Route::get('governorate' , [UserController::class , 'governorate'])->middleware('auth:sanctum');
        Route::get('city' , [UserController::class , 'city'])->middleware('auth:sanctum');
        Route::get('edit-profile/{profile_id}' , [UserController::class , 'editProfile'])->middleware(['auth:sanctum' , 'setApiLocalLang']);
        Route::post('update-profile/{profile_id}' , [UserController::class , 'updateProfile'])->middleware(['auth:sanctum' , 'setApiLocalLang']);
        Route::post('logout' , [UserController::class, 'logout'])->middleware('auth:sanctum');
    });
    Route::middleware('api')->prefix('category')->controller(CategoryController::class)
    ->group(function(){
        Route::get('categories' , 'categories')->middleware('auth:sanctum');
        Route::get('categories/{category_id}/sub-category' , 'subCategory')->middleware('auth:sanctum');
    });
    Route::middleware(['api' , 'auth:sanctum' , 'setApiLocalLang'])->prefix('post')->group(function(){
        Route::post('{category_id}/create' , [PostController::class , 'createPost']);
        Route::get('show' , [PostController::class , 'showPosts']);
        Route::post('add-favorite/{post_id}' , [PostController::class , 'addPostFavorite']);
        Route::get('show-posts-favorite' , [PostController::class , 'showPostsFavorite']);
    });

    Route::middleware(['api' , 'setApiLocalLang' , 'auth:sanctum'])->prefix('relation')->group(function(){
        Route::post('search-user-relation' , [RelationUsersController::class , 'searchUserRelation']);
    })
?>