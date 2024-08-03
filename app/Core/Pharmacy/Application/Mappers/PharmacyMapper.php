<?php

namespace App\Core\Pharmacy\Application\Mappers;

use App\Concerns\BaseMapper;
use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use App\Core\Pharmacy\Domain\Factories\PharmacyFactory;

class PharmacyMapper
{
    use BaseMapper;

    public static function fromRequest(array $request): PharmacyEntity
    {
        return  PharmacyFactory::new($request);
    }

}
