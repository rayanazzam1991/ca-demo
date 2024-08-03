<?php

namespace App\Http\Controllers\V1\Pharmacy;

use App\Concerns\BaseFilter;
use App\Concerns\BaseFilterMapper;
use App\Core\Pharmacy\Application\UseCases\GetList\GetListPharmaciesForDeliveryUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Pharmacy\IndexRequest;
use Illuminate\Http\JsonResponse;

class GetListForDeliveryController extends Controller
{
    public function __construct(private readonly GetListPharmaciesForDeliveryUseCaseInterface $pharmacyUseCase)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request): JsonResponse
    {
        $viewModel = $this->pharmacyUseCase->index(BaseFilterMapper::fromRequest($request->validated()), $request->distributor_id);
        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),
            $viewModel->getPagination()
        ));
    }
}
