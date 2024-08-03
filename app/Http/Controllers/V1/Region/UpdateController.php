<?php

namespace App\Http\Controllers\V1\Region;

use App\Core\Shared\Region\RegionMapper;
use App\Core\Shared\Region\RegionUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Region\UpdateRequest;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    public function __construct(private readonly RegionUseCaseInterface $cityUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request,int $id):JsonResponse
    {
        $this->cityUseCase->update(RegionMapper::fromRequest($request->validated()),$id);
        return ApiResponseHelper::sendResponse(new Result());
    }
}
