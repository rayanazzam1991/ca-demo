<?php

namespace App\Core\Pharmacy\Application\UseCases\GetPharmacy;


use App\Core\Pharmacy\Infrastructure\Eloquent\PharmacyModel;
use App\Core\Shared\User\UserModel;
use App\Http\Resources\V1\User\UserResource;

interface GetParmacyUseCaseOutputInterface
{
    public function signupResponse(UserModel $userModel): UserResource;
}
