<?php
namespace App\Core\Order\Application\UseCases\GetList;

use App\Core\Order\Application\Repositories\GetOrderListGateWayRepositoryInterface;
use App\Core\Order\Application\Repositories\OrderRepositoryInterface;
use Exception;
use Saloon\Exceptions\SaloonException;

class GetOrderListtUseCaseInteractor implements GetOrderListUseCaseInterface
{
    public function __construct(private readonly OrderRepositoryInterface $orderRepository,
                                private readonly GetOrderListGateWayRepositoryInterface $gateWayRepository,
                                private readonly GetOrderListOutputUseCaseInterface $getOrderListOutputUseCase){}

    public function getOrderList()
    {
        $orders = $this->orderRepository->getByUser(auth()->id());
        ($orders->count() != 0)?:throw new SaloonException(__('main.no_orders'),200);
        $data = $this->gateWayRepository->getOrderList($orders);
        return $this->getOrderListOutputUseCase->getOrderList($data);
    }
}
