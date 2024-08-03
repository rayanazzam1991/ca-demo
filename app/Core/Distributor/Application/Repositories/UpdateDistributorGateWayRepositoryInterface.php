<?php

namespace App\Core\Distributor\Application\Repositories;

use App\Core\Distributor\Domain\Entities\DistributorEntity;

interface UpdateDistributorGateWayRepositoryInterface
{
    public function update(DistributorEntity $entity,$domain);
}
