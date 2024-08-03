<?php

namespace App\Core\Auth;

use App\Core\DeliveryMan\Infrastructure\Eloquent\DeliveryManModel;
use App\Http\Resources\V1\Auth\DeliveryLoginResource;
use App\Http\Resources\V1\Auth\LoginResource;

class LoginUseCaseResponse implements LoginUseCaseOutput
{

    public function userVerifiedForLogin(AuthUserDTO $authUserDTO): LoginResource
    {
        return LoginResource::make($authUserDTO);
    }

    public function deliveryVerifiedForLogin(DeliveryManModel $model): DeliveryLoginResource
    {
        return DeliveryLoginResource::make($model);
    }

    public function userVerifiedForSignup(bool $done): bool|null
    {
        return $done ? "Verified" : null;
    }
}
