<?php

namespace App\Http\Controllers\V1\User;

use App\Core\Pharmacy\Application\Mappers\PharmacyMapper;
use App\Core\Shared\User\UserUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\EditProfileRequest;
use Illuminate\Http\JsonResponse;

class EditProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private readonly UserUseCaseInterface $userUseCase){}
    public function __invoke(EditProfileRequest $request):JsonResponse
    {
       return ApiResponseHelper::sendResponse(new result($this->userUseCase->editProfile(PharmacyMapper::fromRequest($request->validated()))));
    }
}
