<?php

namespace App\Http\Controllers\V1\DeliveryMan;

use App\Core\DeliveryMan\Application\Mappers\DeliveryManMapper;
use App\Core\DeliveryMan\Application\UseCases\CreateDeliveryMan\CreateDeliveryManUseCaseInterface;
use App\Core\DeliveryMan\Application\UseCases\SyncDeliveryMan\SyncDeliveryManUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryMan\StoreRequest;
use App\Http\Requests\V1\DeliveryMan\SyncRequest;
use Illuminate\Http\JsonResponse;


class SyncDeliveryManController extends Controller
{
    public function __construct(private readonly SyncDeliveryManUseCaseInterface $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(SyncRequest $request):JsonResponse
    {
        $this->useCaseInteractor->store(DeliveryManMapper::fromRequest($request->validated(),$request->group_codes??[]));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
