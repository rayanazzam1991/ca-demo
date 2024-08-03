<?php

namespace App\Http\Controllers\V1\ActivityLog;

use App\Core\ActivityLog\Application\Filter\ActivtyLogFilter;
use App\Core\ActivityLog\Application\UseCases\GetActivityLogList\GetActivityLogUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ActivityLog\IndexRequest;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __construct(private readonly GetActivityLogUseCaseInterface $logUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $viewModel = $this->logUseCase->index(ActivtyLogFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),
            $viewModel->getPagination()
        ));
    }
}
