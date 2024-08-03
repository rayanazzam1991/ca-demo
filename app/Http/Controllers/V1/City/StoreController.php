<?php

namespace App\Http\Controllers\V1\City;

use App\Core\Shared\City\CityMapper;
use App\Core\Shared\City\CityUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\City\StoreRequest;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __construct(private readonly CityUseCaseInterface $cityUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request):JsonResponse
    {
        $this->cityUseCase->store(CityMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }
}
