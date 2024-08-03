<?php

namespace App\Http\Controllers\V1\Auth;

use App\Core\Auth\LoginUseCase;
use App\Core\Auth\UserVerifyCodeMapper;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\VerifyCodeRequest;
use App\Http\Resources\V1\Auth\CodeVerifiedResource;
use Illuminate\Http\JsonResponse;

class VerifyCodeController extends Controller
{
    public function __construct(private readonly LoginUseCase $loginUseCase)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyCodeRequest $request): JsonResponse
    {
        $data =$this->loginUseCase->verifyCode(UserVerifyCodeMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($data));
    }
}
