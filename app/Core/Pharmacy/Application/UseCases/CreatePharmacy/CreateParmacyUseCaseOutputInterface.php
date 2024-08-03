<?php

namespace App\Core\Pharmacy\Application\UseCases\CreatePharmacy;


use App\Core\Auth\AuthUserDTO;
use App\Http\Resources\V1\Auth\LoginResource;

interface CreateParmacyUseCaseOutputInterface
{
    public function signupResponse(AuthUserDTO $authUserDTO):LoginResource;
}
