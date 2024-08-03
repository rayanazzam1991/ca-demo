<?php

namespace App\Http\Controllers\V1\Auth;

use App\Core\Auth\LoginUseCase;
use App\Core\Auth\UserCodeMapper;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\SendCodeRequest;
use Illuminate\Http\JsonResponse;

class SendCodeController extends Controller
{
    public function __construct(private readonly LoginUseCase $loginUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(SendCodeRequest $request):JsonResponse
    {
        $this->loginUseCase->sendCode(UserCodeMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result('success'));
    }
}
