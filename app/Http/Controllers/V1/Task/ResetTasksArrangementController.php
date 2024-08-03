<?php

namespace App\Http\Controllers\V1\Task;

use App\Core\Task\Application\Mappers\TaskStatusMapper;
use App\Core\Task\Application\UseCases\ResetArrangement\ResetTasksArrangementUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResetTasksArrangementController extends Controller
{
    public function __construct(private readonly ResetTasksArrangementUseCaseInterface $useCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request):JsonResponse
    {  
        $this->useCase->reset();
        return ApiResponseHelper::sendResponse(new Result());
    }
}
