<?php

namespace App\Http\Controllers\V1\Auth;

use App\Core\Auth\AdminMapper;
use App\Core\Auth\LoginUseCase;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\AdminLoginRequest;
use Illuminate\Http\JsonResponse;

class AdminLoginController extends Controller
{
    public function __construct(private readonly LoginUseCase $loginUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(AdminLoginRequest $request):JsonResponse
    {
        $data =$this->loginUseCase->adminLogin(AdminMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result($data));
    }
}
