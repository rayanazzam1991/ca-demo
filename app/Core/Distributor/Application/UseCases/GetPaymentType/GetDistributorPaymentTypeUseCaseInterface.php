<?php

namespace App\Core\Distributor\Application\UseCases\GetPaymentType;

use App\Concerns\BaseTenantEntity;

interface GetDistributorPaymentTypeUseCaseInterface
{
    public function index(BaseTenantEntity $filter);
}
