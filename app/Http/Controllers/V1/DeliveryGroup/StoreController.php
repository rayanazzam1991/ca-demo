<?php

namespace App\Http\Controllers\V1\DeliveryGroup;

use App\Core\DeliveryGroup\Application\Mappers\DeliveryGroupMapper;
use App\Core\DeliveryGroup\Application\UseCases\CreateDeliveryGroup\CreateDeliveryGroupUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryGroup\StoreRequest;
use Illuminate\Http\JsonResponse;


class StoreController extends Controller
{
    public function __construct(
        private readonly CreateDeliveryGroupUseCaseInterface $useCaseInteractor
    ){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request):JsonResponse
    {
        $this->useCaseInteractor->store(DeliveryGroupMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
