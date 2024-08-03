<?php

namespace App\Http\Controllers\V1\Task;

use App\Core\Task\Application\Mappers\TaskStatusMapper;
use App\Core\Task\Application\UseCases\ChangeStatusTask\ChangeStatusTaskUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Task\ChangeStatusRequest;
use Illuminate\Http\JsonResponse;

class ChangeStatusController extends Controller
{
    public function __construct(private readonly ChangeStatusTaskUseCaseInterface $changeStatusTaskUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(ChangeStatusRequest $request,$id):JsonResponse
    {

        $this->changeStatusTaskUseCase->changeStatus(TaskStatusMapper::fromRequest(array_merge($request->validated(),['task_id'=>$id])),$request->distributor_id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
