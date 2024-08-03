<?php

namespace App\Core\Pharmacy\Application\Repositories;

use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;

interface SyncClientGateWayRepositoryInterface
{
    public function sync(PharmacyEntity $entity);
}
