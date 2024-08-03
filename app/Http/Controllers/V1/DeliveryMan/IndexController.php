<?php

namespace App\Http\Controllers\V1\DeliveryMan;

use App\Core\DeliveryMan\Application\Filter\DeliveryManFilter;
use App\Core\DeliveryMan\Application\UseCases\GetDeliveryManList\GetDeliveryManListUseCaseInteractor;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeliveryMan\IndexRequest;
use Illuminate\Http\JsonResponse;


class IndexController extends Controller
{
    public function __construct(private readonly GetDeliveryManListUseCaseInteractor $useCaseInteractor){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $view = $this->useCaseInteractor->index(DeliveryManFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($view->getResource(),$view->getPagination()));
    }
}
