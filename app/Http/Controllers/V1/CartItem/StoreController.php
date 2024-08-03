<?php

namespace App\Http\Controllers\V1\CartItem;

use App\Core\CartItem\Application\Mappers\CartItemMapper;
use App\Core\CartItem\Application\UseCases\CreateCartItem\CreateCartItemUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CartItem\StoreRequest;
use Illuminate\Http\JsonResponse;


class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly CreateCartItemUseCaseInterface $cartItemUseCase){}

    public function __invoke(StoreRequest $request):JsonResponse
    {
        $this->cartItemUseCase->store(CartItemMapper::fromRequest($request->validated()));
        return ApiResponseHelper::sendResponse(new Result());
    }

}
