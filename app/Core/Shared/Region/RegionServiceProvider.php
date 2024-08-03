<?php

namespace App\Core\Shared\Region;

use App\Http\Controllers\V1\Region\ChangeStatusController;
use App\Http\Controllers\V1\Region\IndexController;
use App\Http\Controllers\V1\Region\ShowController;
use App\Http\Controllers\V1\Region\StoreController;
use App\Http\Controllers\V1\Region\UpdateController;
use Illuminate\Support\ServiceProvider;

    class RegionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app
        ->when(IndexController::class)
        ->needs(RegionUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(RegionService::class, [
                'output' => $app->make(RegionUseCaseResponse::class),
            ]);
        });
        $this->app
            ->when(ShowController::class)
            ->needs(RegionUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(RegionService::class, [
                    'output' => $app->make(RegionUseCaseResponse::class),
                ]);
            });
        $this->app
            ->when(StoreController::class)
            ->needs(RegionUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(RegionService::class, [
                    'output' => $app->make(RegionUseCaseResponse::class),
                ]);
            });
        $this->app
            ->when(UpdateController::class)
            ->needs(RegionUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(RegionService::class, [
                    'output' => $app->make(RegionUseCaseResponse::class),
                ]);
            });
        $this->app
            ->when(ChangeStatusController::class)
            ->needs(RegionUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(RegionService::class, [
                    'output' => $app->make(RegionUseCaseResponse::class),
                ]);
            });
        $this->app->bind(RegionUseCaseInterface::class, RegionService::class);
        $this->app->bind(RegionRepositoryInterface::class, RegionRepository::class);
        $this->app->bind(SyncRegionGateWayRepositoryInterface::class, SyncRegionGateway::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
