<?php

namespace App\Http\Controllers\V1\Auth;

use App\Core\Auth\LoginUseCase;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class DeleteAccountController extends Controller
{
    public function __construct(private readonly LoginUseCase $loginUseCase){}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request):JsonResponse
    {
        $this->loginUseCase->delete();
        return ApiResponseHelper::sendResponse(new Result());
    }
}
