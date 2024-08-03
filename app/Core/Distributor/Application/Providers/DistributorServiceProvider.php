<?php

namespace App\Core\Distributor\Application\Providers;

use App\Core\Distributor\Application\Repositories\GetDistributorCategoryGateWayRepositoryInterface;
use App\Core\Distributor\Application\Repositories\SharedSystemRepositoryInterface;
use App\Core\Distributor\Application\Repositories\UpdateDistributorGateWayRepositoryInterface;
use App\Core\Distributor\Application\UseCases\ChangeStatus\ChangeStatusDistributorUseCaseInteractor;
use App\Core\Distributor\Application\UseCases\ChangeStatus\ChangeStatusDistributorUseCaseInterface;
use App\Core\Distributor\Application\UseCases\CreateDistributor\CreateDistributorUseCaseInteractor;
use App\Core\Distributor\Application\UseCases\CreateDistributor\CreateDistributorUseCaseInterface;
use App\Core\Distributor\Application\UseCases\GetCategory\GetDistributorCategoryUseCaseInteractor;
use App\Core\Distributor\Application\UseCases\GetCategory\GetDistributorCategoryUseCaseInterface;
use App\Core\Distributor\Application\UseCases\GetList\GetListDistributorUseCaseInteractor;
use App\Core\Distributor\Application\UseCases\GetList\GetListDistributorUseCaseInterface;
use App\Core\Distributor\Application\UseCases\GetOne\GetOneDistributorUseCaseInteractor;
use App\Core\Distributor\Application\UseCases\GetOne\GetOneDistributorUseCaseInterface;
use App\Core\Distributor\Application\UseCases\GetPaymentType\GetDistributorPaymentTypeUseCaseInteractor;
use App\Core\Distributor\Application\UseCases\GetPaymentType\GetDistributorPaymentTypeUseCaseInterface;
use App\Core\Distributor\Application\UseCases\UpdateDistributor\UpdateDistributorUseCaseInteractor;
use App\Core\Distributor\Application\UseCases\UpdateDistributor\UpdateDistributorUseCaseInterface;
use App\Core\Distributor\Infrastructure\Eloquent\DistributorRepository;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Distributor\Application\Repositories\DistributorsWithManufacturersGateWayRepositoryInterface;
use App\Core\Distributor\Application\Repositories\GetManufacturersListGateWayRepositoryInterface;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Gateway\GetDistributorCategoryGateway;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Gateway\PaymentTypeListGateway;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Gateway\SharedSystemGateway;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Gateway\UpdatetDistributorGateway;
use App\Core\Distributor\Presentation\Presenters\GetListDistributorCategoryUseCaseResponse;
use App\Core\Distributor\Presentation\Presenters\GetListDistributorUseCaseResponse;
use App\Core\Distributor\Presentation\Presenters\GetOneDistributorUseCaseResponse;
use App\Core\Distributor\Application\Repositories\GetPaymentTypeListGateWayRepositoryInterface;
use App\Core\Distributor\Application\UseCases\GetList\GetListDistributorForDeliveryUseCaseInteractor;
use App\Core\Distributor\Application\UseCases\GetList\GetListDistributorForDeliveryUseCaseInterface;
use App\Core\Distributor\Application\UseCases\GetManufacturers\GetDistributorManufacturersUseCaseInteractor;
use App\Core\Distributor\Application\UseCases\GetManufacturers\GetDistributorManufacturersUseCaseInterface;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Gateway\DistributorsWithManufacturersGateway;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Gateway\ManufacturersListGateway;
use App\Core\Distributor\Presentation\Presenters\GetListDistributorForDeliveryManUseCaseResponse;
use App\Http\Controllers\V1\Distributor\ChangeStatusController;
use App\Http\Controllers\V1\Distributor\GetDistributorCategoryController;
use App\Http\Controllers\V1\Distributor\GetDistributorManufacturersController;
use App\Http\Controllers\V1\Distributor\GetDistributorPaymentTypeController;
use App\Http\Controllers\V1\Distributor\GetListForDeliveryController;
use App\Http\Controllers\V1\Distributor\IndexController;
use App\Http\Controllers\V1\Distributor\OnboardController;
use App\Http\Controllers\V1\Distributor\ShowController;
use App\Http\Controllers\V1\Distributor\UpdateController;
use Illuminate\Support\ServiceProvider;

class DistributorServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app
            ->when(IndexController::class)
            ->needs(GetListDistributorUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetListDistributorUseCaseInteractor::class, [
                    'output' => $app->make(GetListDistributorUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(ShowController::class)
            ->needs(GetOneDistributorUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetOneDistributorUseCaseInteractor::class, [
                    'output' => $app->make(GetOneDistributorUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(OnboardController::class)
            ->needs(CreateDistributorUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CreateDistributorUseCaseInteractor::class, []);
            });

        $this->app
            ->when(UpdateController::class)
            ->needs(UpdateDistributorUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(UpdateDistributorUseCaseInteractor::class, []);
            });

        $this->app
            ->when(ChangeStatusController::class)
            ->needs(ChangeStatusDistributorUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(ChangeStatusDistributorUseCaseInteractor::class, []);
            });

        $this->app
            ->when(GetDistributorCategoryController::class)
            ->needs(GetDistributorCategoryUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetDistributorCategoryUseCaseInteractor::class, [
                    'output' => $app->make(GetListDistributorCategoryUseCaseResponse::class, [])
                ]);
            });

        $this->app
            ->when(GetDistributorPaymentTypeController::class)
            ->needs(GetDistributorPaymentTypeUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetDistributorPaymentTypeUseCaseInteractor::class, []);
            });
        $this->app
            ->when(GetListForDeliveryController::class)
            ->needs(GetListDistributorForDeliveryUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetListDistributorForDeliveryUseCaseInteractor::class, [
                    'output' => $app->make(GetListDistributorForDeliveryManUseCaseResponse::class),
                ]);
            });
            $this->app
            ->when(GetDistributorManufacturersController::class)
            ->needs(GetDistributorManufacturersUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetDistributorManufacturersUseCaseInteractor::class, []);
            });

        $this->app->bind(GetDistributorCategoryGateWayRepositoryInterface::class, GetDistributorCategoryGateWay::class);
        $this->app->bind(DistributorRepositoryInterface::class, DistributorRepository::class);
        $this->app->bind(SharedSystemRepositoryInterface::class, SharedSystemGateway::class);
        $this->app->bind(UpdateDistributorGateWayRepositoryInterface::class, UpdatetDistributorGateway::class);
        $this->app->bind(GetPaymentTypeListGateWayRepositoryInterface::class, PaymentTypeListGateway::class);
        $this->app->bind(GetManufacturersListGateWayRepositoryInterface::class, ManufacturersListGateway::class);
        $this->app->bind(DistributorsWithManufacturersGateWayRepositoryInterface::class, DistributorsWithManufacturersGateway::class);

    }

    /**
     * Bootstrap any Application services.
     */
    public function boot(): void
    {
        //
    }
}
