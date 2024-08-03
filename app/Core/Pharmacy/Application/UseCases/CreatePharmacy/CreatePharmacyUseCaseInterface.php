<?php

namespace App\Core\Pharmacy\Application\UseCases\CreatePharmacy;

use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use App\Http\Resources\V1\Auth\LoginResource;

interface CreatePharmacyUseCaseInterface
{
    public function store(PharmacyEntity $pharmacyEntity):LoginResource;
}
