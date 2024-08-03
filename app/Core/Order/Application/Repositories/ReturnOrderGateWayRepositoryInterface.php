<?php

namespace App\Core\Order\Application\Repositories;

use App\Core\Order\Domain\Entities\ReturnOrderEntity;

interface ReturnOrderGateWayRepositoryInterface
{
    public function returnOrder($domain,ReturnOrderEntity $entity);
}
