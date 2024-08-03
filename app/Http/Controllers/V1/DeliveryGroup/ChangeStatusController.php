<?php

namespace App\Http\Controllers\V1\DeliveryGroup;

use App\Concerns\StatusMapper;
use App\Core\DeliveryGroup\Application\UseCases\ChangeStatusDeliveryGroup\ChangeStatusDeliveryGroupUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Banner\ChangeStatusRequest;
use Illuminate\Http\JsonResponse;

class ChangeStatusController extends Controller
{
    public function __construct(private readonly ChangeStatusDeliveryGroupUseCaseInterface $paymentTypeUseCase){}

    public function __invoke(int $id,ChangeStatusRequest $request):JsonResponse
    {
        $this->paymentTypeUseCase->changeStatus(StatusMapper::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
