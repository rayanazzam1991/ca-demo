<?php

namespace App\Http\Controllers\V1\Distributor;

use App\Concerns\BaseTenantMapper;
use App\Core\Distributor\Application\UseCases\GetCategory\GetDistributorCategoryUseCaseInterface;
use App\Core\Distributor\Application\UseCases\GetOne\GetOneDistributorUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Distributor\GetDistributorCategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetDistributorCategoryController extends Controller
{
    public function __construct(private readonly GetDistributorCategoryUseCaseInterface $distributeurUseCase,
    ){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(GetDistributorCategoryRequest $request)
    {
        $viewModel = $this->distributeurUseCase->getDistributorCategory(BaseTenantMapper::fromRequest($request->all()));
        return ApiResponseHelper::sendResponse(new Result($viewModel->getResource()));
    }
}
