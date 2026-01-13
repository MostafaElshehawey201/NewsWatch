<?php

namespace App\Services\User;

use App\Interfaces\User\updateProfileInterface;
use DomainException;

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
    public function methodUpdateProfileInterface($validationUpdateProfileRequest, $updateProfileRequest, $profile_id)
    {
        $returnDataUpdateProfileFromRepository = $this->sendDataUpdateProfileFromServiceToRepositoryByInterface->methodUpdateProfileInterface($validationUpdateProfileRequest, $updateProfileRequest, $profile_id);
        return $returnDataUpdateProfileFromRepository;
    }
    public function logoutAll($request)
    {
        $user = $request->user();
        if (!$user) {
            throw new DomainException(__('validation.user.tokenError'));
        }
        return $user->tokens()->delete();
    }
}
