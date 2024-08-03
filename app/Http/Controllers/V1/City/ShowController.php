<?php

namespace App\Http\Controllers\V1\City;

use App\Core\Shared\City\CityUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __construct(private readonly CityUseCaseInterface $cityUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,int $id):JsonResponse
    {
        $view = $this->cityUseCase->show($id);
        return ApiResponseHelper::sendResponse(new Result($view->getResource()));
    }
}
