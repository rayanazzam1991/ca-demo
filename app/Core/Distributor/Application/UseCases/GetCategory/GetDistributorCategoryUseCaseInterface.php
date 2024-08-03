<?php

namespace App\Core\Distributor\Application\UseCases\GetCategory;

use App\Concerns\BaseTenantEntity;

interface GetDistributorCategoryUseCaseInterface
{
    public function getDistributorCategory(BaseTenantEntity $entity);
}
