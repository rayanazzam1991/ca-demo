<?php

namespace App\Http\Controllers\V1\City;

use App\Core\Shared\City\CityFilter;
use App\Core\Shared\City\CityUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Helpers\ApiHelper\Result;
use App\Http\Requests\V1\City\IndexRequest;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __construct(private readonly CityUseCaseInterface $cityUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $data = $this->cityUseCase->index(CityFilter::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($data['data'],$data['paginate'],'success'));
    }
}
