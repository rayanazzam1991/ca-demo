<?php

namespace App\Core\ActivityLog\Application\Providers;

use App\Core\ActivityLog\Application\Repositories\ActivityLogRepositoryInterface;
use App\Core\ActivityLog\Application\UseCases\GetActivityLogList\GetActivityLogOutputUseCaseInterface;
use App\Core\ActivityLog\Application\UseCases\GetActivityLogList\GetActivityLogUseCaseInteractor;
use App\Core\ActivityLog\Application\UseCases\GetActivityLogList\GetActivityLogUseCaseInterface;
use App\Core\ActivityLog\Infrastructure\Eloquent\ActivityLogRepository;
use App\Core\ActivityLog\Presentation\Presenters\GetActivityLogUseCaseResponse;
use App\Http\Controllers\V1\ActivityLog\IndexController;
use Illuminate\Support\ServiceProvider;

class ActivityLogServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {

        $this->app
        ->when(IndexController::class)
        ->needs(GetActivityLogUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(GetActivityLogUseCaseInteractor::class, [
                'output' =>$app->make(GetActivityLogUseCaseResponse::class)
            ]);
        });

        $this->app->bind(GetActivityLogOutputUseCaseInterface::class, GetActivityLogUseCaseResponse::class);
        $this->app->bind(ActivityLogRepositoryInterface::class, ActivityLogRepository::class);
    }

    /**
     * Bootstrap any Application services.
     */
    public function boot(): void
    {
        //
    }
}
