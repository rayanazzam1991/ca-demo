<?php

namespace App\Core\Pharmacy\Application\UseCases\GetPharmacyAccount;


use App\Core\Pharmacy\Infrastructure\Eloquent\PharmacyModel;
use App\Core\Shared\User\UserModel;
use App\Http\Resources\V1\User\UserResource;

interface GetPharmacyAccountUseCaseOutputInterface
{
    public function signupResponse(UserModel $userModel): UserResource;
}
