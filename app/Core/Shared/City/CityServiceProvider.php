<?php

namespace App\Core\Shared\City;


use App\Http\Controllers\V1\City\ChangeStatusController;
use App\Http\Controllers\V1\City\IndexController;
use App\Http\Controllers\V1\City\ShowController;
use App\Http\Controllers\V1\City\StoreController;
use App\Http\Controllers\V1\City\UpdateController;
use Illuminate\Support\ServiceProvider;

class CityServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app
            ->when(IndexController::class)
            ->needs(CityUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CityService::class, [
                    'output' => $app->make(CityUseCaseResponse::class),
                ]);
            });
        $this->app
            ->when(ShowController::class)
            ->needs(CityUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CityService::class, [
                    'output' => $app->make(CityUseCaseResponse::class),
                ]);
            });
        $this->app
            ->when(StoreController::class)
            ->needs(CityUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CityService::class, [
                    'output' => $app->make(CityUseCaseResponse::class),
                ]);
            });
        $this->app
            ->when(UpdateController::class)
            ->needs(CityUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CityService::class, [
                    'output' => $app->make(CityUseCaseResponse::class),
                ]);
            });
        $this->app
            ->when(ChangeStatusController::class)
            ->needs(CityUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CityService::class, [
                    'output' => $app->make(CityUseCaseResponse::class),
                ]);
            });
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(SyncCityGateWayRepositoryInterface::class, SyncCityGateway::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
