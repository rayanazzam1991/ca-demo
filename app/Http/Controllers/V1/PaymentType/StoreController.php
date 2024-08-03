<?php

namespace App\Http\Controllers\V1\PaymentType;

use App\Core\PaymentType\Application\Mappers\PaymentTypeMapper;
use App\Core\PaymentType\Application\UseCases\CreatePaymentType\CreatePaymentTypeUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PaymentType\StoreRequest;
use Illuminate\Http\JsonResponse;


class StoreController extends Controller
{
    public function __construct(private readonly CreatePaymentTypeUseCaseInterface $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request):JsonResponse
    {
        $this->useCaseInteractor->store(PaymentTypeMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
