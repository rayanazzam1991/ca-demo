<?php

namespace App\Http\Controllers\V1\Cart;

use App\Core\Cart\Application\UseCases\DeleteCart\DeleteCartUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly DeleteCartUseCaseInterface $cartUseCase){}

    public function __invoke(Request $request):JsonResponse
    {
        $this->cartUseCase->deleteCart();
        return ApiResponseHelper::sendResponse(new Result());
    }

}
