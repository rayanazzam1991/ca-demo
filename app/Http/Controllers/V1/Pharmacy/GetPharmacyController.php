<?php

namespace App\Http\Controllers\V1\Pharmacy;

use App\Core\Pharmacy\Application\UseCases\GetPharmacy\GetPharmacyUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetPharmacyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private readonly GetPharmacyUseCaseInterface $pharmacyUseCase){}
    public function __invoke(Request $request):JsonResponse
    {
       return ApiResponseHelper::sendResponse(new result($this->pharmacyUseCase->getPharmacy()));
    }
}
