<?php

namespace App\Repositories\Auth;

use Exception;
use App\Models\Otp;
use App\Models\role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Auth\AuthLoginInterface;
use App\Interfaces\Auth\AuthForgetPasswordInterface;

class AuthRepository implements AuthInterface , AuthLoginInterface , AuthForgetPasswordInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function MethodRegisterInterface($validateAuth)
    {
        try {
            if (User::where('email', $validateAuth['email'])->exists()) {
                throw new Exception(__('authRegister.email.unique'));
            }
            if (User::where('phone', $validateAuth['phone'])->exists()) {
                throw new Exception(__('authRegister.phone.unique'));
            }
            $user = User::create([
                "name" => $validateAuth['name'],
                "email" => $validateAuth['email'],
                "phone" => $validateAuth['phone'],
                "password" => Hash::make($validateAuth['password']),
            ]);
            role::create([
                "user_id" => $user->id,
                "role_user" => $validateAuth['role_user'] ?? 'visitor'
            ]);
            return $user;
        } catch (Exception $error) {
            throw new Exception(($error->getMessage()));
        }
    }

    public function MethodAuthLoginInterface($validationAuthRequestLogin){
        try{
            $user = User::where(function($query) use ($validationAuthRequestLogin){
                $query->where('email' , $validationAuthRequestLogin['login'])
                ->orWhere('phone' , $validationAuthRequestLogin['login']);
            })->first();
            if(!$user){
                throw new Exception(__('authLogin.failed'));
            }
            return $user;
        }catch(Exception $error){
            throw new Exception(($error->getMessage()));
        }
    }
    
    public function methodAuthForgetPAsswordInterface($validationAuthRequestForgetPassword){
        try{
            $user = User::where(function($query) use ($validationAuthRequestForgetPassword){
                $query->where('email' , $validationAuthRequestForgetPassword['login'])
                ->orWhere('phone' , $validationAuthRequestForgetPassword['login']);
            })->first();
            if(!$user){
                throw new Exception(__('authLogin.failed'));
            }
            $otp = rand(100000 , 999999);
            Otp::create([
                "user_id" => $user->id,
                "otp" => $otp,
                "expires_at" => now()->addMinutes(2),
            ]);
            return $otp;
        }catch(Exception $errors){
            throw new Exception($errors->getMessage());
        }
    }
}
