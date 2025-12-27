<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

    Route::middleware('api')->prefix('auth')->group(function (){
        Route::post("register" , [AuthController::class , 'register'])->middleware('setApiLocalLang');
    })
?>