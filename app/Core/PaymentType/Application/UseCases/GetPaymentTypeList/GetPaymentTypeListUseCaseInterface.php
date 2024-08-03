<?php

namespace App\Core\PaymentType\Application\UseCases\GetPaymentTypeList;


use App\Concerns\BaseFilter;
use App\Core\Favourite\Domain\Entities\FavouriteEntity;

interface GetPaymentTypeListUseCaseInterface
{
    public function index(BaseFilter $filter);
}
