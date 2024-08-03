<?php

namespace App\Core\Shared\City;

use App\Core\Shared\Region\RegionEntity;

interface SyncCityGateWayRepositoryInterface
{
    public function sync(CityEntity $entity);
}
