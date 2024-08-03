<?php

namespace App\Http\Controllers\V1\DeliveryMan;

use App\Core\DeliveryMan\Application\UseCases\ChangeAvailability\ChangeAvailabilityUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryMan\ChangeAvailabilityRequest;
use Illuminate\Http\JsonResponse;

class ChangeAvailabilityController extends Controller
{
    public function __construct(private readonly ChangeAvailabilityUseCaseInterface $useCase){}

    public function __invoke(ChangeAvailabilityRequest $request):JsonResponse
    {
        $this->useCase->change($request->is_online);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
