<?php

namespace App\Core\Order\Application\Repositories;

interface CancelOrderGateWayRepositoryInterface
{
    public function cancelOrder($domain,int $order_id);
}
