<?php

namespace App\Http\Controllers\V1\Distributor;

use App\Concerns\BaseTenantMapper;
use App\Core\Distributor\Application\UseCases\GetPaymentType\GetDistributorPaymentTypeUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Distributor\GetDistributorCategoryRequest;

class GetDistributorPaymentTypeController extends Controller
{
    public function __construct(private readonly GetDistributorPaymentTypeUseCaseInterface $distributeurUseCase,
    ){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(GetDistributorCategoryRequest $request)
    {
        $viewModel = $this->distributeurUseCase->index(BaseTenantMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($viewModel));
    }
}
