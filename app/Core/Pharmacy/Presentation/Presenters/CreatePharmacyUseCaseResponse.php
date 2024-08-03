<?php

namespace App\Core\Pharmacy\Presentation\Presenters;
use App\Core\Auth\AuthUserDTO;
use App\Core\Pharmacy\Application\UseCases\CreatePharmacy\CreateParmacyUseCaseOutputInterface;
use App\Http\Resources\V1\Auth\LoginResource;

class CreatePharmacyUseCaseResponse implements CreateParmacyUseCaseOutputInterface
{
    public function signupResponse(AuthUserDTO $authUserDTO): LoginResource
    {
        return LoginResource::make($authUserDTO);
    }
}
