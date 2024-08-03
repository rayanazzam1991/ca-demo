<?php
namespace App\Core\Order\Application\Providers;

use App\Core\DistributorSubscription\Application\Repositories\StoreSubscriptionGateWayRepositoryInterface;
use App\Core\DistributorSubscription\Infrastructure\SharedSystem\Integration\Gateway\StoreSubscriptionGateway;
use App\Core\Order\Application\Repositories\CancelOrderGateWayRepositoryInterface;
use App\Core\Order\Application\Repositories\CreateOrderGateWayRepositoryInterface;
use App\Core\Order\Application\Repositories\GetOrderGateWayRepositoryInterface;
use App\Core\Order\Application\Repositories\GetOrderListGateWayRepositoryInterface;
use App\Core\Order\Application\Repositories\OrderRepositoryInterface;
use App\Core\Order\Application\Repositories\ReturnOrderGateWayRepositoryInterface;
use App\Core\Order\Application\UseCases\CancelOrder\CancelOrderUseCaseInteractor;
use App\Core\Order\Application\UseCases\CancelOrder\CancelOrderUseCaseInterface;
use App\Core\Order\Application\UseCases\CreateOrder\CreateOrderUseCaseInteractor;
use App\Core\Order\Application\UseCases\CreateOrder\CreateOrderUseCaseInterface;
use App\Core\Order\Application\UseCases\GetList\GetOrderListOutputUseCaseInterface;
use App\Core\Order\Application\UseCases\GetList\GetOrderListtUseCaseInteractor;
use App\Core\Order\Application\UseCases\GetList\GetOrderListUseCaseInterface;
use App\Core\Order\Application\UseCases\GetOne\GetOrderOutputUseCaseInterface;
use App\Core\Order\Application\UseCases\GetOne\GetOrderUseCaseInteractor;
use App\Core\Order\Application\UseCases\GetOne\GetOrderUseCaseInterface;
use App\Core\Order\Application\UseCases\ReturnOrder\ReturnOrderUseCaseInteractor;
use App\Core\Order\Application\UseCases\ReturnOrder\ReturnOrderUseCaseInterface;
use App\Core\Order\Infrastructure\Eloquent\OrderRepository;
use App\Core\Order\Infrastructure\SharedSystem\Integration\Gateway\CancelOrderGateway;
use App\Core\Order\Infrastructure\SharedSystem\Integration\Gateway\CreateOrderGateway;
use App\Core\Order\Infrastructure\SharedSystem\Integration\Gateway\OrderGateway;
use App\Core\Order\Infrastructure\SharedSystem\Integration\Gateway\OrderListGateway;
use App\Core\Order\Infrastructure\SharedSystem\Integration\Gateway\ReturnOrderGateway;
use App\Core\Order\Presentation\Presenters\GetOrderListUseCaseResponse;
use App\Core\Order\Presentation\Presenters\GetOrderUseCaseResponse;
use App\Http\Controllers\V1\Order\CancelOrderController;
use App\Http\Controllers\V1\Order\IndexController;
use App\Http\Controllers\V1\Order\ReturnOrderController;
use App\Http\Controllers\V1\Order\ShowController;
use App\Http\Controllers\V1\Order\StoreController;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app
            ->when(StoreController::class)
            ->needs(CreateOrderUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CreateOrderUseCaseInteractor::class, [

                ]);
            });
        $this->app
            ->when(IndexController::class)
            ->needs(GetOrderListUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetOrderListtUseCaseInteractor::class, [
                ]);
            });

        $this->app
            ->when(ShowController::class)
            ->needs(GetOrderUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetOrderUseCaseInteractor::class, [
                ]);
            });
        $this->app
            ->when(CancelOrderController::class)
            ->needs(CancelOrderUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CancelOrderUseCaseInteractor::class, [
                ]);
            });
        $this->app
            ->when(ReturnOrderController::class)
            ->needs(ReturnOrderUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(ReturnOrderUseCaseInteractor::class, [
                ]);
            });

        $this->app->bind(ReturnOrderGateWayRepositoryInterface::class,ReturnOrderGateway::class);
        $this->app->bind(CancelOrderGateWayRepositoryInterface::class,CancelOrderGateway::class);
        $this->app->bind(GetOrderListGateWayRepositoryInterface::class,OrderListGateway::class);
        $this->app->bind(GetOrderGateWayRepositoryInterface::class,OrderGateway::class);
        $this->app->bind(CreateOrderGateWayRepositoryInterface::class,CreateOrderGateWay::class);
        $this->app->bind(OrderRepositoryInterface::class,OrderRepository::class);
        $this->app->bind(GetOrderListOutputUseCaseInterface::class,GetOrderListUseCaseResponse::class);
        $this->app->bind(GetOrderOutputUseCaseInterface::class,GetOrderUseCaseResponse::class);
        $this->app->bind(StoreSubscriptionGateWayRepositoryInterface::class,StoreSubscriptionGateway::class);
    }

    /**
     * Bootstrap any Application services.
     */
    public function boot(): void
    {
        //
    }
}
