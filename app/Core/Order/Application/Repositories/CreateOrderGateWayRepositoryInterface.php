<?php

namespace App\Core\Order\Application\Repositories;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Order\Domain\Entities\OrderEntity;
use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use Illuminate\Pagination\LengthAwarePaginator;

interface CreateOrderGateWayRepositoryInterface
{
    public function store(OrderEntity $entity,PharmacyEntity $pharmacyEntity,$domain);
}
