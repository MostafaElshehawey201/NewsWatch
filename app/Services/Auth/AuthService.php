<?php

namespace App\Services\Auth;

use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Auth\AuthLoginInterface;
use App\Interfaces\Auth\AuthCheckOtpInterface;
use App\Interfaces\Auth\AuthForgetPasswordInterface;

class AuthService implements AuthInterface , AuthLoginInterface 
, AuthForgetPasswordInterface , AuthCheckOtpInterface
{
    /**
     * Create a new class instance.
     */
    public $sendDataFromServiceToRepositoryByInterface;
    protected $sendDataLoginFromServiceToRepositoryByInterface;
    public $sendDataForgetPasswordFromServiceToRepositoryByInterface;
    public $sendDataCheckOtpFromServiceToRepositoryByInterface;
    public function __construct(AuthInterface $authInterface , AuthLoginInterface $authLoginInterface , AuthForgetPasswordInterface $authForgetPasswordInterface , AuthCheckOtpInterface $authCheckOtpInterface)
    {
        $this->sendDataFromServiceToRepositoryByInterface = $authInterface;
        $this->sendDataLoginFromServiceToRepositoryByInterface = $authLoginInterface;
        $this->sendDataForgetPasswordFromServiceToRepositoryByInterface = $authForgetPasswordInterface;
        $this->sendDataCheckOtpFromServiceToRepositoryByInterface = $authCheckOtpInterface;
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
}
