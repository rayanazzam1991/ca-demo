<?php

namespace App\Http\Controllers\V1\Region;

use App\Core\Shared\Region\RegionUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __construct(private readonly RegionUseCaseInterface $cityUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,int $id):JsonResponse
    {
        $view = $this->cityUseCase->show($id);
        return ApiResponseHelper::sendResponse(new Result($view->getResource()));
    }
}
