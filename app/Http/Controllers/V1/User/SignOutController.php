<?php

namespace App\Http\Controllers\V1\User;

use App\Core\Shared\User\UserUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SignOutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __construct(private readonly UserUseCaseInterface $userUseCase){}
    public function __invoke():JsonResponse
    {
        $this->userUseCase->signOut();
        return ApiResponseHelper::sendResponse(new result());
    }
}
