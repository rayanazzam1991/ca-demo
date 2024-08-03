<?php

namespace App\Core\Pharmacy\Application\Providers;

use App\Core\Pharmacy\Application\Repositories\GetPharmaciesListGateWayRepositoryInterface;
use App\Core\Pharmacy\Application\Repositories\PharmacyRepositoryInterface;
use App\Core\Pharmacy\Application\Repositories\SyncClientGateWayRepositoryInterface;
use App\Core\Pharmacy\Application\UseCases\CreatePharmacy\CreatePharmacyUseCaseInteractor;
use App\Core\Pharmacy\Application\UseCases\CreatePharmacy\CreatePharmacyUseCaseInterface;
use App\Core\Pharmacy\Application\UseCases\EditPharmacy\EditPharmacyUseCaseInteractor;
use App\Core\Pharmacy\Application\UseCases\EditPharmacy\EditPharmacyUseCaseInterface;
use App\Core\Pharmacy\Application\UseCases\GetList\GetListPharmaciesForDeliveryUseCaseInteractor;
use App\Core\Pharmacy\Application\UseCases\GetList\GetListPharmaciesForDeliveryUseCaseInterface;
use App\Core\Pharmacy\Application\UseCases\GetPharmacy\GetPharmacyUseCaseInteractor;
use App\Core\Pharmacy\Application\UseCases\GetPharmacy\GetPharmacyUseCaseInterface;
use App\Core\Pharmacy\Application\UseCases\GetPharmacyAccount\GetPharmacyAccountUseCaseInteractor;
use App\Core\Pharmacy\Application\UseCases\GetPharmacyAccount\GetPharmacyAccountUseCaseInterface;
use App\Core\Pharmacy\Infrastructure\Eloquent\PharmacyRepository;
use App\Core\Pharmacy\Infrastructure\SharedSystem\Integration\Gateway\ClientListGateway;
use App\Core\Pharmacy\Infrastructure\SharedSystem\Integration\Gateway\SyncClientGateway;
use App\Core\Pharmacy\Presentation\Presenters\CreatePharmacyUseCaseResponse;
use App\Core\Pharmacy\Presentation\Presenters\GetListPharmacyUseCaseResponse;
use App\Core\Pharmacy\Presentation\Presenters\GetPharmacyUseCaseResponse;
use App\Core\Shared\Address\AddressRepository;
use App\Core\Shared\Address\AddressRepositoryInterface;
use App\Core\Shared\User\UserRepository;
use App\Core\Shared\User\UserRepositoryInterface;
use App\Http\Controllers\V1\Auth\SignupControoler;
use App\Http\Controllers\V1\Pharmacy\EditPharmacyController;
use App\Http\Controllers\V1\Pharmacy\GetListForDeliveryController;
use App\Http\Controllers\V1\Pharmacy\GetPharmacyController;
use App\Http\Controllers\V1\Pharmacy\ShowController;
use Illuminate\Support\ServiceProvider;

class PharmacyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app
            ->when(SignupControoler::class)
            ->needs(CreatePharmacyUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CreatePharmacyUseCaseInteractor::class, [
                    'output' => $app->make(CreatePharmacyUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(GetPharmacyController::class)
            ->needs(GetPharmacyUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetPharmacyUseCaseInteractor::class, [
                    'output' => $app->make(GetPharmacyUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(EditPharmacyController::class)
            ->needs(EditPharmacyUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(EditPharmacyUseCaseInteractor::class, [
                    'output' => $app->make(GetPharmacyUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(ShowController::class)
            ->needs(GetPharmacyAccountUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetPharmacyAccountUseCaseInteractor::class, [
                    'output' => $app->make(GetPharmacyUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(GetListForDeliveryController::class)
            ->needs(GetListPharmaciesForDeliveryUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetListPharmaciesForDeliveryUseCaseInteractor::class, [
                    'output' => $app->make(GetListPharmacyUseCaseResponse::class),
                ]);
            });

        $this->app->bind(PharmacyRepositoryInterface::class, PharmacyRepository::class);
        $this->app->bind(SyncClientGateWayRepositoryInterface::class, SyncClientGateway::class);
        $this->app->bind(GetPharmaciesListGateWayRepositoryInterface::class, ClientListGateway::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
