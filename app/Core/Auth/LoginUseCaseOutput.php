<?php

namespace App\Core\Auth;

use App\Core\DeliveryMan\Infrastructure\Eloquent\DeliveryManModel;
use App\Http\Resources\V1\Auth\DeliveryLoginResource;

interface LoginUseCaseOutput
{

    public function userVerifiedForLogin(AuthUserDTO $authUserDTO);
    public function deliveryVerifiedForLogin(DeliveryManModel $model): DeliveryLoginResource;

    public function userVerifiedForSignup(bool $done);

}
