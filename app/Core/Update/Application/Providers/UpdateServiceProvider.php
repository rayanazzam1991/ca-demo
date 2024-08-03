<?php

namespace App\Core\Update\Application\Providers;

use App\Core\Update\Application\Repositories\UpdateRepositoryInterface;
use App\Core\Update\Application\UseCases\CreateUpdate\CreateUpdateUseCase;
use App\Core\Update\Application\UseCases\CreateUpdate\CreateUpdateUseCaseInteractor;
use App\Core\Update\Application\UseCases\GetList\GetUpdatesUseCase;
use App\Core\Update\Application\UseCases\GetList\GetUpdatesUseCaseInteractor;
use App\Core\Update\Application\UseCases\GetOne\GetUpdateUseCase;
use App\Core\Update\Application\UseCases\GetOne\GetUpdateUseCaseInteractor;
use App\Core\Update\Infrastructure\Eloquent\UpdateEloquentRepository;
use App\Core\Update\Presentation\Presenters\CreateUpdateResponse;
use App\Core\Update\Presentation\Presenters\GetUpdateResponse;
use App\Core\Update\Presentation\Presenters\GetUpdatesResponse;
use App\Http\Controllers\V1\Update\CreateUpdateController;
use App\Http\Controllers\V1\Update\IndexController;
use App\Http\Controllers\V1\Update\ShowController;
use Illuminate\Support\ServiceProvider;

class UpdateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app
            ->when(CreateUpdateController::class)
            ->needs(CreateUpdateUseCase::class)
            ->give(function ($app) {
                return $app->make(CreateUpdateUseCaseInteractor::class, [
                    'output' => $app->make(CreateUpdateResponse::class)
                ]);
            });

        $this->app
            ->when(IndexController::class)
            ->needs(GetUpdatesUseCase::class)
            ->give(function ($app) {
                return $app->make(GetUpdatesUseCaseInteractor::class, [
                    'output' => $app->make(GetUpdatesResponse::class)
                ]);
            });

        $this->app
            ->when(ShowController::class)
            ->needs(GetUpdateUseCase::class)
            ->give(function ($app) {
                return $app->make(GetUpdateUseCaseInteractor::class, [
                    'output' => $app->make(GetUpdateResponse::class)
                ]);
            });

        $this->app->bind(UpdateRepositoryInterface::class, UpdateEloquentRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
