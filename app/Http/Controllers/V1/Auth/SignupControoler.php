<?php

namespace App\Http\Controllers\V1\Auth;

use App\Core\Pharmacy\Application\Mappers\PharmacyMapper;
use App\Core\Pharmacy\Application\UseCases\CreatePharmacy\CreatePharmacyUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\SignupRequest;
use Illuminate\Http\JsonResponse;


class SignupControoler extends Controller
{
    public function __construct(private readonly CreatePharmacyUseCaseInterface $pharmacyUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(SignupRequest $request):JsonResponse
    {
        $data  = $this->pharmacyUseCase->store(PharmacyMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($data));
    }
}
