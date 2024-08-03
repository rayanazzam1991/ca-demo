<?php

namespace App\Http\Controllers\V1\Feed;

use App\Concerns\StatusEntity;
use App\Concerns\StatusMapper;
use App\Core\Feed\Application\UseCases\ChangeStatus\ChangeStatusUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Feed\ChangeStatusRequest;
use Illuminate\Http\JsonResponse;

class ChangeStatusController extends Controller
{
    public function __construct(private readonly ChangeStatusUseCaseInterface $feedUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(ChangeStatusRequest $request,int $id):JsonResponse
    {
        $this->feedUseCase->ChangeStatus(StatusMapper::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
