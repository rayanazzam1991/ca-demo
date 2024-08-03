<?php
namespace App\Core\PaymentType\Application\Providers;

use App\Core\PaymentType\Application\Repositories\PaymentMethodRepositoryInterface;
use App\Core\PaymentType\Application\Repositories\SyncPaymentTypeGateWayRepositoryInterface;
use App\Core\PaymentType\Application\UseCases\ChangeStatusPaymentType\ChangeStatusPaymentTypeUseCaseInteractor;
use App\Core\PaymentType\Application\UseCases\ChangeStatusPaymentType\ChangeStatusPaymentTypeUseCaseInterface;
use App\Core\PaymentType\Application\UseCases\CreatePaymentType\CreatePaymentTypeUseCaseInterface;
use App\Core\PaymentType\Application\UseCases\CreatePaymentType\CreatePaymentTypeUseCaseInteractor;
use App\Core\PaymentType\Application\UseCases\GetPaymentType\GetPaymentTypeOutputUseCaseInterface;
use App\Core\PaymentType\Application\UseCases\GetPaymentType\GetPaymentTypeUseCaseInteractor;
use App\Core\PaymentType\Application\UseCases\GetPaymentType\GetPaymentTypeUseCaseInterface;
use App\Core\PaymentType\Application\UseCases\GetPaymentTypeList\GetPaymentTypeListOutputUseCaseInterface;
use App\Core\PaymentType\Application\UseCases\GetPaymentTypeList\GetPaymentTypeListUseCaseInteractor;
use App\Core\PaymentType\Application\UseCases\GetPaymentTypeList\GetPaymentTypeListUseCaseInterface;
use App\Core\PaymentType\Application\UseCases\UpdatePaymentType\UpdatePaymentTypeUseCaseInteractor;
use App\Core\PaymentType\Application\UseCases\UpdatePaymentType\UpdatePaymentTypeUseCaseInterface;
use App\Core\PaymentType\Infrastructure\Eloquent\PaymentTypeRepository;
use App\Core\PaymentType\Infrastructure\SharedSystem\Integration\Gateway\SyncPaymentTypeGateway;
use App\Core\PaymentType\Presentation\Presenters\GetPaymentTypeListUseCaseResponse;
use App\Core\PaymentType\Presentation\Presenters\GetPaymentTypeUseCaseResponse;
use App\Http\Controllers\V1\PaymentType\ChangeStatusController;
use App\Http\Controllers\V1\PaymentType\IndexController;
use App\Http\Controllers\V1\PaymentType\ShowController;
use App\Http\Controllers\V1\PaymentType\StoreController;
use App\Http\Controllers\V1\PaymentType\UpdateController;
use Illuminate\Support\ServiceProvider;

class PaymentTypeServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app
        ->when(IndexController::class)
        ->needs(GetPaymentTypeListUseCaseInterface::class)
        ->give(function ($app) {return $app->make(GetPaymentTypeListUseCaseInteractor::class, []);});
        $this->app
        ->when(ShowController::class)
        ->needs(GetPaymentTypeUseCaseInterface::class)
        ->give(function ($app) {return $app->make(GetPaymentTypeUseCaseInteractor::class, []);});
        $this->app
        ->when(StoreController::class)
        ->needs(CreatePaymentTypeUseCaseInterface::class)
        ->give(function ($app) {return $app->make(CreatePaymentTypeUseCaseInteractor::class, []);});
        $this->app
        ->when(UpdateController::class)
        ->needs(UpdatePaymentTypeUseCaseInterface::class)
        ->give(function ($app) {return $app->make(UpdatePaymentTypeUseCaseInteractor::class, []);});
        $this->app
        ->when(ChangeStatusController::class)
        ->needs(ChangeStatusPaymentTypeUseCaseInterface::class)
        ->give(function ($app) {return $app->make(ChangeStatusPaymentTypeUseCaseInteractor::class, []);});

        $this->app->bind(GetPaymentTypeListOutputUseCaseInterface::class, GetPaymentTypeListUseCaseResponse::class);
        $this->app->bind(GetPaymentTypeOutputUseCaseInterface::class, GetPaymentTypeUseCaseResponse::class);
        $this->app->bind(PaymentMethodRepositoryInterface::class, PaymentTypeRepository::class);
        $this->app->bind(SyncPaymentTypeGateWayRepositoryInterface::class, SyncPaymentTypeGateway::class);
    }

    /**
     * Bootstrap any Application services.
     */
    public function boot(): void
    {
        //
    }
}
