<?php

namespace App\Core\Order\Application\UseCases\CancelOrder;

interface CancelOrderUseCaseInterface
{
    public function cancelOrder(int $id);
}
