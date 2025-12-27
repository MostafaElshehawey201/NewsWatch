<?php

namespace App\Services\Auth;

use App\Interfaces\Auth\AuthInterface;
use App\Interfaces\Auth\AuthLoginInterface;

class AuthService implements AuthInterface , AuthLoginInterface
{
    /**
     * Create a new class instance.
     */
    public $sendDataFromServiceToRepositoryByInterface;
    protected $sendDataLoginFromServiceToRepositoryByInterface;
    public function __construct(AuthInterface $authInterface , AuthLoginInterface $authLoginInterface)
    {
        $this->sendDataFromServiceToRepositoryByInterface = $authInterface;
        $this->sendDataLoginFromServiceToRepositoryByInterface = $authLoginInterface;
    }

    public function MethodRegisterInterface($validateAuth){
        $returnDataFromRepository = $this->sendDataFromServiceToRepositoryByInterface->MethodRegisterInterface($validateAuth);
        return $returnDataFromRepository;
    }

    public function MethodAuthLoginInterface($validationAuthRequestLogin){
        $returnDataLoginFromRepository = $this->sendDataLoginFromServiceToRepositoryByInterface->MethodAuthLoginInterface($validationAuthRequestLogin);
        return $returnDataLoginFromRepository;
    }
}
