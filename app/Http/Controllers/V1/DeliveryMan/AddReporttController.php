<?php

namespace App\Http\Controllers\V1\DeliveryMan;

use App\Core\DeliveryMan\Application\Mappers\PaymentMapper;
use App\Core\DeliveryMan\Application\Mappers\ReportMapper;
use App\Core\DeliveryMan\Application\UseCases\AddPayment\AddPaymentUseCaseInteractor;
use App\Core\DeliveryMan\Application\UseCases\AddReport\AddReportUseCaseInteractor;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryMan\AddPaymentRequest;
use App\Http\Requests\V1\DeliveryMan\AddReportRequest;
use Illuminate\Http\JsonResponse;


class AddReporttController extends Controller
{
    public function __construct(private readonly AddReportUseCaseInteractor $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(AddReportRequest $request):JsonResponse
    {
        $this->useCaseInteractor->store(ReportMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
