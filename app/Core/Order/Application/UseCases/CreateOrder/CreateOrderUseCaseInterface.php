<?php

namespace App\Core\Order\Application\UseCases\CreateOrder;

use App\Core\Order\Domain\Entities\OrderEntity;

interface CreateOrderUseCaseInterface
{
    public function store(string $payment_type_code):void;
}
