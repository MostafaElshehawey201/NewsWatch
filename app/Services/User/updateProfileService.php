<?php

namespace App\Services\User;

use App\Interfaces\User\updateProfileInterface;

class updateProfileService implements updateProfileInterface
{
    /**
     * Create a new class instance.
     */
    public $sendDataUpdateProfileFromServiceToRepositoryByInterface;
    public function __construct(updateProfileInterface $updateProfileInterface)
    {
        $this->sendDataUpdateProfileFromServiceToRepositoryByInterface = $updateProfileInterface;
    }
    public function methodUpdateProfileInterface($validationUpdateProfileRequest , $updateProfileRequest){
        $returnDataUpdateProfileFromRepository = $this->sendDataUpdateProfileFromServiceToRepositoryByInterface->methodUpdateProfileInterface($validationUpdateProfileRequest , $updateProfileRequest);
        return $returnDataUpdateProfileFromRepository;
    }
}
