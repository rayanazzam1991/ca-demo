<?php

namespace App\Http\Controllers\V1\Region;

use App\Core\Shared\Region\RegionMapper;
use App\Core\Shared\Region\RegionUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Region\StoreRequest;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __construct(private readonly RegionUseCaseInterface $cityUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request):JsonResponse
    {
        $this->cityUseCase->store(RegionMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
