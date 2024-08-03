<?php

namespace App\Core\Order\Application\Repositories;

interface GetOrderListGateWayRepositoryInterface
{
    public function getOrderList($orders);
}
