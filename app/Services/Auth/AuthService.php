<?php

namespace App\Services\Auth;

use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Auth\AuthLoginInterface;
use App\Interfaces\Auth\AuthCheckOtpInterface;
use App\Interfaces\Auth\AuthForgetPasswordInterface;
use App\Interfaces\Auth\AuthResetPasswordInterface;

class AuthService implements AuthInterface , AuthLoginInterface 
, AuthForgetPasswordInterface , AuthCheckOtpInterface , AuthResetPasswordInterface
{
    /**
     * Create a new class instance.
     */
    public $sendDataFromServiceToRepositoryByInterface;
    protected $sendDataLoginFromServiceToRepositoryByInterface;
    public $sendDataForgetPasswordFromServiceToRepositoryByInterface;
    public $sendDataCheckOtpFromServiceToRepositoryByInterface;
    public $sendDataResetPasswordFromServiceToRepositoryByInterface;
    public function __construct(AuthInterface $authInterface , AuthLoginInterface $authLoginInterface 
    , AuthForgetPasswordInterface $authForgetPasswordInterface , 
    AuthCheckOtpInterface $authCheckOtpInterface ,
    AuthResetPasswordInterface $authResetPasswordInterface)
    {
        $this->sendDataFromServiceToRepositoryByInterface = $authInterface;
        $this->sendDataLoginFromServiceToRepositoryByInterface = $authLoginInterface;
        $this->sendDataForgetPasswordFromServiceToRepositoryByInterface = $authForgetPasswordInterface;
        $this->sendDataCheckOtpFromServiceToRepositoryByInterface = $authCheckOtpInterface;
        $this->sendDataResetPasswordFromServiceToRepositoryByInterface = $authResetPasswordInterface;
    }

    public function MethodRegisterInterface($validateAuth){
        $returnDataFromRepository = $this->sendDataFromServiceToRepositoryByInterface->MethodRegisterInterface($validateAuth);
        return $returnDataFromRepository;
    }

    public function MethodAuthLoginInterface($validationAuthRequestLogin){
        $returnDataLoginFromRepository = $this->sendDataLoginFromServiceToRepositoryByInterface->MethodAuthLoginInterface($validationAuthRequestLogin);
        $token = $returnDataLoginFromRepository->createToken('auth-token')->plainTextToken;
        return [
            "user" => $returnDataLoginFromRepository,
            "token" => $token,
        ];
    }

    public function methodAuthForgetPAsswordInterface($validationAuthRequestForgetPassword){
        $returnDataForgetPasswordFromRepository = $this->sendDataForgetPasswordFromServiceToRepositoryByInterface->methodAuthForgetPAsswordInterface($validationAuthRequestForgetPassword);
        return $returnDataForgetPasswordFromRepository;
    }

    public function methodCheckOtpInterface($validationAuthCheckOtpRequest){
        $returnUserDataCheckOtpFromRepository = $this->sendDataCheckOtpFromServiceToRepositoryByInterface->methodCheckOtpInterface($validationAuthCheckOtpRequest);
        $token = $returnUserDataCheckOtpFromRepository->createToken('auth-token')->plainTextToken;
        return [
            "user" => $returnUserDataCheckOtpFromRepository,
            "token" => $token,
        ];
    }

    public function methodResetPasswordInterface($authResetPasswordRequest , $request){
        $returnDataResetPasswordFromRepository = $this->sendDataResetPasswordFromServiceToRepositoryByInterface->methodResetPasswordInterface($authResetPasswordRequest , $request);
        return $returnDataResetPasswordFromRepository;
    }
}
