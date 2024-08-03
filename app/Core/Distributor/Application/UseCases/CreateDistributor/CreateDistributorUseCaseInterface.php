<?php

namespace App\Core\Distributor\Application\UseCases\CreateDistributor;


use App\Core\Distributor\Domain\Entities\DistributorEntity;

interface CreateDistributorUseCaseInterface
{
    public function store(DistributorEntity $distributorEntity, string $username);
}
