<?php

namespace App\Core\Order\Application\Repositories;

interface GetOrderGateWayRepositoryInterface
{
    public function getOrder($domain,int $order_id);
}
