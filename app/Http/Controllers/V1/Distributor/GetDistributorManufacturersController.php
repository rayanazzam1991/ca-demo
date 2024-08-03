<?php

namespace App\Http\Controllers\V1\Distributor;

use App\Concerns\BaseTenantMapper;
use App\Core\Distributor\Application\UseCases\GetManufacturers\GetDistributorManufacturersUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Distributor\GetDistributorCategoryRequest;

class GetDistributorManufacturersController extends Controller
{
    public function __construct(private readonly GetDistributorManufacturersUseCaseInterface $distributeurUseCase,
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
