<?php

namespace App\Http\Controllers\V1\Update;

use App\Core\Update\Application\Filter\UpdateFilter;
use App\Core\Update\Application\UseCases\GetList\GetUpdatesUseCase;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Update\IndexRequest;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private readonly GetUpdatesUseCase $getUpdatesUseCase){}
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $viewModel = $this->getUpdatesUseCase->getUpdates(UpdateFilter::fromRequest($request->validated()));

        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),
            $viewModel->getPagination()
        ));
    }
}
