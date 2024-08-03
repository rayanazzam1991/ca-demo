<?php

namespace App\Core\Order\Application\UseCases\ReturnOrder;

use App\Core\Order\Domain\Entities\ReturnOrderEntity;

interface ReturnOrderUseCaseInterface
{
    public function returnOrder(ReturnOrderEntity $entity);
}
