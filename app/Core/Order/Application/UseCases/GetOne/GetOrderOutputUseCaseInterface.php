<?php

namespace App\Core\Order\Application\UseCases\GetOne;

interface GetOrderOutputUseCaseInterface
{
    public function getOrder($order,$distributor);
}
