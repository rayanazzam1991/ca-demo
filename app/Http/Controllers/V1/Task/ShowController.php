<?php

namespace App\Http\Controllers\V1\Task;

use App\Core\Task\Application\Filter\TaskFilter;
use App\Core\Task\Application\UseCases\GetTask\GetTaskUseCaseInterface;
use App\Core\Task\Application\UseCases\GetTaskList\GetTaskListUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Task\IndexRequest;
use App\Http\Requests\V1\Task\ShowRequest;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    public function __construct(private readonly GetTaskUseCaseInterface $getTaskListUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(ShowRequest $request,$id):JsonResponse
    {
        $viewModel = $this->getTaskListUseCase->show($id,$request->distributor_id);
        return ApiResponseHelper::sendResponse(new Result(
            $viewModel->getResource(),
        ));
    }
}
