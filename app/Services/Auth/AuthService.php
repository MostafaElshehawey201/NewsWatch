<?php

namespace App\Services\Auth;

use App\Interfaces\Auth\AuthInterface;

class AuthService implements AuthInterface
{
    /**
     * Create a new class instance.
     */
    public $sendDataFromServiceToRepositoryByInterface;
    public function __construct(AuthInterface $authInterface)
    {
        $this->sendDataFromServiceToRepositoryByInterface = $authInterface;
    }

    public function MethodRegisterInterface($validateAuth){
        $returnDataFromRepository = $this->sendDataFromServiceToRepositoryByInterface->MethodRegisterInterface($validateAuth);
        return $returnDataFromRepository;
    }
}
