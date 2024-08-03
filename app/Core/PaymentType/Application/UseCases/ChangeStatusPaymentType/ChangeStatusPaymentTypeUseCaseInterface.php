<?php

namespace App\Core\PaymentType\Application\UseCases\ChangeStatusPaymentType;

use App\Concerns\StatusEntity;
use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;

interface ChangeStatusPaymentTypeUseCaseInterface
{
    public function changeStatus(StatusEntity $entity,int $id);
}
