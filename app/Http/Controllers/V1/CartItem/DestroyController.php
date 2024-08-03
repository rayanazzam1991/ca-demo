<?php

namespace App\Http\Controllers\V1\CartItem;

use App\Core\CartItem\Application\UseCases\DeleteCartItem\DeleteCartItemUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly DeleteCartItemUseCaseInterface $cartItemUseCase){}

    public function __invoke(Request $request,$id):JsonResponse
    {
        $this->cartItemUseCase->delete($id);
        return ApiResponseHelper::sendResponse(new Result());
    }

}
