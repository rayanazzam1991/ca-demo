<?php

namespace App\Core\PaymentType\Application\UseCases\GetPaymentType;

use App\Concerns\BaseFilter;
use App\Core\Favourite\Domain\Entities\FavouriteEntity;

interface GetPaymentTypeUseCaseInterface
{
    public function show(int $id);
}
