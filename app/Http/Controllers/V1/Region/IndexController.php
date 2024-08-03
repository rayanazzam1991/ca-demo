<?php

namespace App\Http\Controllers\V1\Region;

use App\Core\Shared\Region\RegionFilter;
use App\Core\Shared\Region\RegionUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Helpers\ApiHelper\Result;
use App\Http\Requests\V1\Region\IndexRequest;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __construct(private readonly RegionUseCaseInterface $cityUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $data = $this->cityUseCase->index(RegionFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($data['data'],$data['paginate'],'success'));
    }
}
