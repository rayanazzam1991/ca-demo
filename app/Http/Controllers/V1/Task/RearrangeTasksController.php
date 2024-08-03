<?php

namespace App\Http\Controllers\V1\Task;

use App\Core\Task\Application\Mappers\RearrangeTasksMapper;
use App\Core\Task\Application\UseCases\RearrangeTasks\RearrangeTasksUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Task\RearrangeTasksRequest;
use Illuminate\Http\JsonResponse;

class RearrangeTasksController extends Controller
{
    public function __construct(private readonly RearrangeTasksUseCaseInterface $useCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(RearrangeTasksRequest $request):JsonResponse
    {

        $this->useCase->rearrange(RearrangeTasksMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
