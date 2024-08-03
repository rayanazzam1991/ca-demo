<?php

namespace App\Http\Controllers\V1\DeliveryMan;

use App\Core\DeliveryMan\Application\Mappers\DeliveryManMapper;
use App\Core\DeliveryMan\Application\UseCases\CreateDeliveryMan\CreateDeliveryManUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryMan\StoreRequest;
use Illuminate\Http\JsonResponse;


class StoreController extends Controller
{
    public function __construct(private readonly CreateDeliveryManUseCaseInterface $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request):JsonResponse
    {
        $this->useCaseInteractor->store(DeliveryManMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
