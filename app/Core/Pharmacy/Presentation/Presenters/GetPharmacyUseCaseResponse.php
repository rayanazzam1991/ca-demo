<?php

namespace App\Core\Pharmacy\Presentation\Presenters;
use App\Core\Auth\AuthUserDTO;
use App\Core\Pharmacy\Application\UseCases\CreatePharmacy\CreateParmacyUseCaseOutputInterface;
use App\Core\Pharmacy\Application\UseCases\GetPharmacy\GetParmacyUseCaseOutputInterface;
use App\Core\Pharmacy\Infrastructure\Eloquent\PharmacyModel;
use App\Core\Shared\User\UserModel;
use App\Http\Resources\V1\Auth\LoginResource;
use App\Http\Resources\V1\User\UserResource;

class GetPharmacyUseCaseResponse implements GetParmacyUseCaseOutputInterface
{
    public function signupResponse(UserModel $userModel): UserResource
    {
        return UserResource::make($userModel);
    }
}
