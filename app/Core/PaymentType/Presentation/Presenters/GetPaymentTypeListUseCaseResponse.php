<?php

namespace App\Core\PaymentType\Presentation\Presenters;

use App\Core\Item\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Core\PaymentType\Application\UseCases\GetPaymentTypeList\GetPaymentTypeListOutputUseCaseInterface;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\V1\PaymentType\PaymentTypeResource;

class GetPaymentTypeListUseCaseResponse implements GetPaymentTypeListOutputUseCaseInterface
{
    public function index($types)
    {
        return new JsonPaginationResourceViewModel(PaymentTypeResource::collection($types),PaginationResource::make($types));
    }
}
