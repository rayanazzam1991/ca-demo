<?php

namespace App\Core\PaymentType\Presentation\Presenters;

use App\Core\Item\Presentation\ViewModels\JsonResourceViewModel;
use App\Core\PaymentType\Application\UseCases\GetPaymentType\GetPaymentTypeOutputUseCaseInterface;
use App\Http\Resources\V1\PaymentType\PaymentTypeResource;

class GetPaymentTypeUseCaseResponse implements GetPaymentTypeOutputUseCaseInterface
{
    public function show($type)
    {
        return new JsonResourceViewModel(PaymentTypeResource::make($type));
    }
}
