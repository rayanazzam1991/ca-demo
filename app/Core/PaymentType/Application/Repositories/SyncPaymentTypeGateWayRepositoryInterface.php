<?php

namespace App\Core\PaymentType\Application\Repositories;

use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;

interface SyncPaymentTypeGateWayRepositoryInterface
{
    public function sync(PaymentTypeEntity $type);
}
