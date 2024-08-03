<?php

namespace App\Http\Controllers\V1\Shift;

use App\Core\Shift\Application\UseCases\GetShiftList\GetShiftListUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private readonly GetShiftListUseCaseInterface $getShiftListUseCase){}
    public function __invoke(Request $request):JsonResponse
    {
        $shifts = $this->getShiftListUseCase->index();
       return ApiResponseHelper::sendResponse(new result($shifts->getResource()));
    }
}
