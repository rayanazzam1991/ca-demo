<?php

namespace App\Http\Controllers\V1\Task;

use App\Core\Task\Application\Filter\TaskFilter;
use App\Core\Task\Application\UseCases\GetTaskList\GetTaskListUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Task\IndexRequest;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __construct(private readonly GetTaskListUseCaseInterface $getTaskListUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $viewModel = $this->getTaskListUseCase->index(TaskFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),
            $viewModel->getPagination()
        ));
    }
}
