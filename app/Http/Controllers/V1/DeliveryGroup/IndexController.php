<?php

namespace App\Http\Controllers\V1\DeliveryGroup;

use App\Core\DeliveryGroup\Application\Filter\DeliveryGroupFilter;
use App\Core\DeliveryGroup\Application\UseCases\GetDeliveryGroupList\GetDeliveryGroupListUseCaseInteractor;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryGroup\IndexRequest;
use Illuminate\Http\JsonResponse;


class IndexController extends Controller
{
    public function __construct(private readonly GetDeliveryGroupListUseCaseInteractor $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $view = $this->useCaseInteractor->index(DeliveryGroupFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($view->getResource(),$view->getPagination()));
    }
}
