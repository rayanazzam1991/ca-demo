<?php

namespace App\Http\Controllers\V1\User;

use App\Core\Auth\LoginService;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Update\IndexRequest;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private readonly LoginService $loginService){}
    public function __invoke(IndexRequest $request):JsonResponse
    {
        $viewModel = $this->loginService->index();
        return ApiResponseHelper::sendResponse(new Result($viewModel));
    }
}
