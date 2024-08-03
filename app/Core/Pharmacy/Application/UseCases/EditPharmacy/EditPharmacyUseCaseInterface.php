<?php

namespace App\Core\Pharmacy\Application\UseCases\EditPharmacy;

use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use App\Http\Resources\V1\User\UserResource;

interface EditPharmacyUseCaseInterface
{
    public function EditPharmacy(PharmacyEntity $pharmacyEntity):void;
}
