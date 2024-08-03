<?php

namespace App\Http\Controllers\V1\Cart;

use App\Core\Cart\Application\UseCases\GetCart\GetCartUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly GetCartUseCaseInterface $cartUseCase){}

    public function __invoke(Request $request):JsonResponse
    {
        $viewModel = $this->cartUseCase->getCart();
        return ApiResponseHelper::sendResponse(new Result(['items'=>$viewModel->getResource(),'cart'=>$viewModel->getCart()]));
    }

}
