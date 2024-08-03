<?php

namespace App\Http\Controllers\V1\Pharmacy;

use App\Core\Pharmacy\Application\Mappers\PharmacyMapper;
use App\Core\Pharmacy\Application\UseCases\EditPharmacy\EditPharmacyUseCaseInterface;
use App\Core\Shared\User\UserUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\EditProfileRequest;
use Illuminate\Http\JsonResponse;

class EditPharmacyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private readonly EditPharmacyUseCaseInterface $pharmacyUseCase){}
    public function __invoke(EditProfileRequest $request):JsonResponse
    {
        $this->pharmacyUseCase->EditPharmacy(PharmacyMapper::fromRequest($request->validated()));
       return ApiResponseHelper::sendResponse(new result());
    }
}
