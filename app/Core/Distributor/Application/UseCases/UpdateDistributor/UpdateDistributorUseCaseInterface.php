<?php

namespace App\Core\Distributor\Application\UseCases\UpdateDistributor;


use App\Core\Distributor\Domain\Entities\DistributorEntity;

interface UpdateDistributorUseCaseInterface
{
    public function update(int $id,DistributorEntity $distributorEntity):void;
}
