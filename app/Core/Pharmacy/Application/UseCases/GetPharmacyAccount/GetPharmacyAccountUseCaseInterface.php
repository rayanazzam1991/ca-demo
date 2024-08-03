<?php

namespace App\Core\Pharmacy\Application\UseCases\GetPharmacyAccount;

use App\Http\Resources\V1\User\UserResource;

interface GetPharmacyAccountUseCaseInterface
{
    public function show($id):UserResource;
}
