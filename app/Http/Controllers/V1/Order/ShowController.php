<?php

namespace App\Http\Controllers\V1\Order;

use App\Core\Order\Application\UseCases\GetList\GetOrderListUseCaseInterface;
use App\Core\Order\Application\UseCases\GetOne\GetOrderUseCaseInterface;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use App\Http\Requests\V1\Order\ShowRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Exception
     */
    public function __construct(private readonly GetOrderUseCaseInterface $orderUseCase){}

    public function __invoke(ShowRequest $request,int $id):JsonResponse
    {
        $viewModel = $this->orderUseCase->getOrder($id,$request->distributor_id);
        return ApiResponseHelper::sendResponse(new Result($viewModel->getResource()));
    }

}
