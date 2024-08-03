<?php
namespace App\Core\Shift\Application\Providers;

use App\Core\Shift\Infrastructure\SharedSystem\Integration\Gateway\CreateShiftGateway;
use App\Core\Shift\Application\Repositories\CreateShiftGateWayRepositoryInterface;
use App\Core\Shift\Application\Repositories\ShiftRepositoryInterface;
use App\Core\Shift\Application\UseCases\CreateShift\CreateShiftUseCaseInteractor;
use App\Core\Shift\Application\UseCases\CreateShift\CreateShiftUseCaseInterface;
use App\Core\Shift\Application\UseCases\GetShiftList\GetShiftistOutputUseCaseInterface;
use App\Core\Shift\Application\UseCases\GetShiftList\GetShiftListUseCaseInteractor;
use App\Core\Shift\Application\UseCases\GetShiftList\GetShiftListUseCaseInterface;
use App\Core\Shift\Infrastructure\Eloquent\ShiftRepository;
use App\Core\Shift\Presentation\Presenters\GetShiftListUseCaseResponse;
use App\Http\Controllers\V1\Shift\IndexController;
use App\Http\Controllers\V1\Shift\StoreController;
use Illuminate\Support\ServiceProvider;

class ShiftServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app
            ->when(IndexController::class)
            ->needs(GetShiftListUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetShiftListUseCaseInteractor::class, []);
            });

        $this->app
            ->when(StoreController::class)
            ->needs(CreateShiftUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CreateShiftUseCaseInteractor::class, []);
            });

        $this->app->bind(ShiftRepositoryInterface::class,ShiftRepository::class);
        $this->app->bind(GetShiftistOutputUseCaseInterface::class,GetShiftListUseCaseResponse::class);
        $this->app->bind(CreateShiftGateWayRepositoryInterface::class,CreateShiftGateway::class);
    }

    /**
     * Bootstrap any Application services.
     */
    public function boot(): void
    {
        //
    }
}
