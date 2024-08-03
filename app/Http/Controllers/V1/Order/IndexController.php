<?php

namespace App\Http\Controllers\V1\Order;

use App\Core\Order\Application\UseCases\GetList\GetOrderListUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly GetOrderListUseCaseInterface $orderUseCase){}

    public function __invoke(Request $request):JsonResponse
    {
        $viewModel = $this->orderUseCase->getOrderList();
        return ApiResponseHelper::sendResponse(new Result($viewModel->getResource()));
    }

}
