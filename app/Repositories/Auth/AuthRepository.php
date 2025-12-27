<?php

namespace App\Repositories\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\Auth\AuthInterface;

class AuthRepository implements AuthInterface
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
            return $user;
        } catch (Exception $error) {
            throw new Exception(($error->getMessage()));
        }
    }
}
