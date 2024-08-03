<?php

namespace App\Http\Controllers\V1\Order;

use App\Core\Order\Application\Mappers\ReturnOrderMapper;
use App\Core\Order\Application\UseCases\ReturnOrder\ReturnOrderUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Order\ReturnRequest;
use Illuminate\Http\JsonResponse;


class ReturnOrderController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly ReturnOrderUseCaseInterface $orderUseCase){}

    public function __invoke(ReturnRequest $request,int $id):JsonResponse
    {
        $this->orderUseCase->returnOrder(ReturnOrderMapper::fromRequest(array_merge(['order_id' => $id],$request->validated())));
        return ApiResponseHelper::sendResponse(new Result());
    }

}
