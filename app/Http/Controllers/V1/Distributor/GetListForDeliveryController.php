<?php

namespace App\Http\Controllers\V1\Distributor;

use App\Core\Distributor\Application\Filter\DistributorFilter;
use App\Core\Distributor\Application\UseCases\GetList\GetListDistributorForDeliveryUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Distributor\IndexRequest;
use Illuminate\Http\JsonResponse;

class GetListForDeliveryController extends Controller
{
    public function __construct(private readonly GetListDistributorForDeliveryUseCaseInterface $distributeurUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $viewModel = $this->distributeurUseCase->index(DistributorFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),
            $viewModel->getPagination()
        ));
    }
}