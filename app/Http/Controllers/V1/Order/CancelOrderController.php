<?php

namespace App\Http\Controllers\V1\Order;

use App\Core\Order\Application\UseCases\CancelOrder\CancelOrderUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class CancelOrderController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly CancelOrderUseCaseInterface $orderUseCase){}

    public function __invoke(Request $request,int $id):JsonResponse
    {
        $this->orderUseCase->cancelOrder($id);
        return ApiResponseHelper::sendResponse(new Result());
    }

}
