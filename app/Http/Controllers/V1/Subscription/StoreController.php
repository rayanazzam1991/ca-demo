<?php

namespace App\Http\Controllers\V1\Subscription;

use App\Core\Distributor\Application\Mappers\DistributorMapper;
use App\Core\DistributorSubscription\Application\Mappers\DistributorSubscriptionMapper;
use App\Core\DistributorSubscription\Application\UseCases\StoreSubscription\StoreSubscriptionsUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Subscription\CreateSubscriptionRequest;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __construct(private readonly StoreSubscriptionsUseCaseInterface $subscriptionsUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateSubscriptionRequest $request):JsonResponse
    {
        $this->subscriptionsUseCase->store(DistributorSubscriptionMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
