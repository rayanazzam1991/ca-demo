<?php

namespace App\Http\Controllers\V1\Subscription;

use App\Concerns\StatusMapper;
use App\Core\DistributorSubscription\Application\UseCases\ChangeStatus\ChangeStatusDistributorSubscriptionUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Banner\ChangeStatusRequest;
use Illuminate\Http\JsonResponse;

class ChangeStatusController extends Controller
{
    public function __construct(private readonly ChangeStatusDistributorSubscriptionUseCaseInterface $subscriptionUseCase){}

    public function __invoke(int $id,ChangeStatusRequest $request):JsonResponse
    {
        $this->subscriptionUseCase->changeStatus($id,StatusMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
