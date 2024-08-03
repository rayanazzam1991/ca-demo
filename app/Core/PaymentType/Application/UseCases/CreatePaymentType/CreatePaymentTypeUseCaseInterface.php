<?php

namespace App\Core\PaymentType\Application\UseCases\CreatePaymentType;

use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;

interface CreatePaymentTypeUseCaseInterface
{
    public function store(PaymentTypeEntity $entity);
}
