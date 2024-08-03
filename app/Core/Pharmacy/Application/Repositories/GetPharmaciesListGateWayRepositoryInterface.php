<?php

namespace App\Core\Pharmacy\Application\Repositories;

use App\Concerns\BaseFilter;

interface GetPharmaciesListGateWayRepositoryInterface
{
    public function getPharmaciesList(BaseFilter $baseFIlter ,string $domain);
}
