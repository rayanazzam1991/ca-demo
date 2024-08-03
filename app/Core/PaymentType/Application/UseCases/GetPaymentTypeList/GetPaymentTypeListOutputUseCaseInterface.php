<?php

namespace App\Core\PaymentType\Application\UseCases\GetPaymentTypeList;

use App\Concerns\BaseFilter;

interface GetPaymentTypeListOutputUseCaseInterface
{
    public function index($types);
}
