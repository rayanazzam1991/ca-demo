<?php

namespace App\Http\Controllers\V1\Auth;

use App\Core\Auth\LoginUseCase;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\StoreFcmTokenRequest;
use Illuminate\Http\JsonResponse;


class StoreFcmTokenController extends Controller
{
    public function __construct(private readonly LoginUseCase $loginUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreFcmTokenRequest $request):JsonResponse
    {
        $this->loginUseCase->setFcmToken($request->fcm_token,$request->lang??'ar');
        return ApiResponseHelper::sendResponse(new Result());
    }
}
