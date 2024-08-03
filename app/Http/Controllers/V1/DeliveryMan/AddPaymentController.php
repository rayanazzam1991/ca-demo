<?php

namespace App\Http\Controllers\V1\DeliveryMan;

use App\Core\DeliveryMan\Application\Mappers\PaymentMapper;
use App\Core\DeliveryMan\Application\UseCases\AddPayment\AddPaymentUseCaseInteractor;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryMan\AddPaymentRequest;
use Illuminate\Http\JsonResponse;


class AddPaymentController extends Controller
{
    public function __construct(private readonly AddPaymentUseCaseInteractor $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(AddPaymentRequest $request):JsonResponse
    {
        $this->useCaseInteractor->store(PaymentMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
