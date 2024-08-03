<?php

namespace App\Core\Order\Application\UseCases\GetOne;

interface GetOrderUseCaseInterface
{
    public function getOrder(int $id,int $distributor_id);
}
