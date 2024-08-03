<?php

namespace App\Http\Controllers\V1\Subscription;

use App\Concerns\BaseFilterMapper;
use App\Core\DistributorSubscription\Application\Filter\SubscriptionFilter;
use App\Core\DistributorSubscription\Application\UseCases\GetList\GetSubscriptionsUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use App\Http\Requests\V1\Subscription\IndexRequest;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __construct(private readonly GetSubscriptionsUseCaseInterface $getSubscriptionsUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $viewModel = $this->getSubscriptionsUseCase->getList(SubscriptionFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),
            $viewModel->getPagination()
        ));
    }
}
