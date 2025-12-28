<?php

namespace App\Repositories\Auth;

use Exception;
use App\Models\role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Auth\AuthLoginInterface;

class AuthRepository implements AuthInterface , AuthLoginInterface
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
}
