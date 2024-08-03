<?php

namespace App\Core\Pharmacy\Application\UseCases\EditPharmacy;


use App\Core\Pharmacy\Infrastructure\Eloquent\PharmacyModel;
use App\Http\Resources\V1\User\UserResource;

interface EditParmacyUseCaseOutputInterface
{
    public function signupResponse(PharmacyModel $pharmacyModel): UserResource;
}
