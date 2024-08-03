<?php

namespace App\Core\Distributor\Application\Repositories;

use App\Core\Distributor\Application\DTO\DistributorDTO;
use App\Core\Distributor\Domain\Entities\DistributorEntity;

interface SharedSystemRepositoryInterface
{

    public function createDB(DistributorDTO $distributorDTO,$paymentTypes,$groups,$deliveryMen,$cities,$regions,$sub_regions,$manufacturers,string $username,string $password, string $alameenKey);

    public function updateOwnerInfo();
}
