<?php

namespace App\Core\Distributor\Application\UseCases\GetManufacturers;

use App\Concerns\BaseTenantEntity;

interface GetDistributorManufacturersUseCaseInterface
{
    public function index(BaseTenantEntity $filter);
}
