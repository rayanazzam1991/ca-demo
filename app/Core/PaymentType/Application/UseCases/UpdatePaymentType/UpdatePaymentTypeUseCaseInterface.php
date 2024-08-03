<?php

namespace App\Core\PaymentType\Application\UseCases\UpdatePaymentType;

use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;

interface UpdatePaymentTypeUseCaseInterface
{
    public function update(PaymentTypeEntity $entity,int $id);
}
