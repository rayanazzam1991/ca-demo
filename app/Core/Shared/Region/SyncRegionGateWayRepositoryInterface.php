<?php

namespace App\Core\Shared\Region;

use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;
use App\Core\Shared\City\CityEntity;

interface SyncRegionGateWayRepositoryInterface
{
    public function sync(RegionEntity $entity);
}
