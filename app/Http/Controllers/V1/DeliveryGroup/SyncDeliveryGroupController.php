<?php

namespace App\Http\Controllers\V1\DeliveryGroup;

use App\Core\DeliveryGroup\Application\UseCases\SyncDeliveryGroup\SyncDeliveryGroupUseCaseInterface;
use App\Core\DeliveryGroup\Application\Mappers\DeliveryGroupMapper;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryGroup\SyncRequest;
use Illuminate\Http\JsonResponse;


class SyncDeliveryGroupController extends Controller
{
    public function __construct(private readonly SyncDeliveryGroupUseCaseInterface $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(SyncRequest $request):JsonResponse
    {
        $this->useCaseInteractor->store(DeliveryGroupMapper::fromRequest($request->validated(),$request->group_codes??[]));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
