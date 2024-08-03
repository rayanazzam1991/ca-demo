<?php

namespace App\Core\Pharmacy\Application\UseCases\GetPharmacy;

use App\Http\Resources\V1\User\UserResource;

interface GetPharmacyUseCaseInterface
{
    public function getPharmacy():UserResource;
}
