<?php

namespace App\Http\Controllers\V1\Region;

use App\Concerns\StatusMapper;
use App\Core\Shared\Region\RegionUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Banner\ChangeStatusRequest;
use Illuminate\Http\JsonResponse;

class ChangeStatusController extends Controller
{
    public function __construct(private readonly RegionUseCaseInterface $regionUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(ChangeStatusRequest $request,int $id):JsonResponse
    {
        $this->regionUseCase->changeStatus(StatusMapper::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
