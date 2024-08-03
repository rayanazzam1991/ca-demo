<?php

namespace App\Http\Controllers\V1\Order;

use App\Core\Order\Application\UseCases\CreateOrder\CreateOrderUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Order\StoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly CreateOrderUseCaseInterface $orderUseCase){}

    public function __invoke(StoreRequest $request):JsonResponse
    {
        $this->orderUseCase->store($request->payment_type_code);
        return ApiResponseHelper::sendResponse(new Result());
    }

}
