<?php

namespace App\Services\Auth;

use App\Interfaces\Auth\AuthForgetPasswordInterface;
use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Auth\AuthLoginInterface;

class AuthService implements AuthInterface , AuthLoginInterface , AuthForgetPasswordInterface
{
    /**
     * Create a new class instance.
     */
    public $sendDataFromServiceToRepositoryByInterface;
    protected $sendDataLoginFromServiceToRepositoryByInterface;
    public $sendDataForgetPasswordFromServiceToRepositoryByInterface;
    public function __construct(AuthInterface $authInterface , AuthLoginInterface $authLoginInterface , AuthForgetPasswordInterface $authForgetPasswordInterface)
    {
        $this->sendDataFromServiceToRepositoryByInterface = $authInterface;
        $this->sendDataLoginFromServiceToRepositoryByInterface = $authLoginInterface;
        $this->sendDataForgetPasswordFromServiceToRepositoryByInterface = $authForgetPasswordInterface;
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
}
