<?php

namespace App\Http\Controllers\V1\City;

use App\Concerns\StatusMapper;
use App\Core\Shared\City\CityUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Banner\ChangeStatusRequest;
use Illuminate\Http\JsonResponse;

class ChangeStatusController extends Controller
{
    public function __construct(private readonly CityUseCaseInterface $cityUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(ChangeStatusRequest $request,int $id):JsonResponse
    {
        $this->cityUseCase->changeStatus(StatusMapper::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
