<?php

namespace App\Core\Task\Application\Providers;

use App\Core\Task\Application\Repositories\GetPackageGateWayRepositoryInterface;
use App\Core\Task\Application\Repositories\GetTaskGateWayRepositoryInterface;
use App\Core\Task\Application\Repositories\GetTaskListGateWayRepositoryInterface;
use App\Core\Task\Application\Repositories\RearrangeTasksGatewayRepositoryInterface;
use App\Core\Task\Application\Repositories\ResetTasksArrangementGatewayRepositoryInterface;
use App\Core\Task\Application\Repositories\TaskChangeStatusGateWayRepositoryInterface;
use App\Core\Task\Application\UseCases\ChangeStatusTask\ChangeStatusTaskUseCaseInteractor;
use App\Core\Task\Application\UseCases\ChangeStatusTask\ChangeStatusTaskUseCaseInterface;
use App\Core\Task\Application\UseCases\GetPackage\GetPackageOutUseCaseInterface;
use App\Core\Task\Application\UseCases\GetPackage\GetPackageUseCaseInteractor;
use App\Core\Task\Application\UseCases\GetPackage\GetPackageUseCaseInterface;
use App\Core\Task\Application\UseCases\GetTask\GetTaskOutUseCaseInterface;
use App\Core\Task\Application\UseCases\GetTask\GetTaskUseCaseInteractor;
use App\Core\Task\Application\UseCases\GetTask\GetTaskUseCaseInterface;
use App\Core\Task\Application\UseCases\GetTaskList\GetTaskListOutUseCaseInterface;
use App\Core\Task\Application\UseCases\GetTaskList\GetTaskListUseCaseInteractor;
use App\Core\Task\Application\UseCases\GetTaskList\GetTaskListUseCaseInterface;
use App\Core\Task\Application\UseCases\RearrangeTasks\RearrangeTasksUseCaseInteractor;
use App\Core\Task\Application\UseCases\RearrangeTasks\RearrangeTasksUseCaseInterface;
use App\Core\Task\Application\UseCases\ResetArrangement\ResetTasksArrangementUseCaseInteractor;
use App\Core\Task\Application\UseCases\ResetArrangement\ResetTasksArrangementUseCaseInterface;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway\ChangeStatusTaskGateway;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway\GetPackageGateway;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway\GetTaskGateway;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway\GetTaskListGateway;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway\RearrangeTasksGateway;
use App\Core\Task\Infrastructure\SharedSystem\Integration\Gateway\ResetTasksArrangementGateway;
use App\Core\Task\Presentation\Presenters\GetPackageUseCaseResponse;
use App\Core\Task\Presentation\Presenters\GetTaskListUseCaseResponse;
use App\Core\Task\Presentation\Presenters\GetTaskUseCaseResponse;
use App\Http\Controllers\V1\Task\ChangeStatusController;
use App\Http\Controllers\V1\Task\GetPackageController;
use App\Http\Controllers\V1\Task\IndexController;
use App\Http\Controllers\V1\Task\RearrangeTasksController;
use App\Http\Controllers\V1\Task\ResetTasksArrangementController;
use App\Http\Controllers\V1\Task\ShowController;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app
            ->when(IndexController::class)
            ->needs(GetTaskListUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetTaskListUseCaseInteractor::class, []);
            });
        $this->app
            ->when(ShowController::class)
            ->needs(GetTaskUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetTaskUseCaseInteractor::class, []);
            });
        $this->app
            ->when(ChangeStatusController::class)
            ->needs(ChangeStatusTaskUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(ChangeStatusTaskUseCaseInteractor::class, []);
            });
        $this->app
            ->when(GetPackageController::class)
            ->needs(GetPackageUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetPackageUseCaseInteractor::class, []);
            });
        $this->app
            ->when(ResetTasksArrangementController::class)
            ->needs(ResetTasksArrangementUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(ResetTasksArrangementUseCaseInteractor::class, []);
            });

        $this->app
            ->when(RearrangeTasksController::class)
            ->needs(RearrangeTasksUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(RearrangeTasksUseCaseInteractor::class, []);
            });


        $this->app->bind(GetPackageGateWayRepositoryInterface::class, GetPackageGateway::class);
        $this->app->bind(GetTaskListGateWayRepositoryInterface::class, GetTaskListGateway::class);
        $this->app->bind(GetTaskGateWayRepositoryInterface::class, GetTaskGateway::class);
        $this->app->bind(TaskChangeStatusGateWayRepositoryInterface::class, ChangeStatusTaskGateway::class);
        $this->app->bind(GetTaskListOutUseCaseInterface::class, GetTaskListUseCaseResponse::class);
        $this->app->bind(GetTaskOutUseCaseInterface::class, GetTaskUseCaseResponse::class);
        $this->app->bind(GetPackageOutUseCaseInterface::class, GetPackageUseCaseResponse::class);
        $this->app->bind(ResetTasksArrangementGatewayRepositoryInterface::class, ResetTasksArrangementGateway::class);
        $this->app->bind(RearrangeTasksGatewayRepositoryInterface::class, RearrangeTasksGateway::class);
    }

    /**
     * Bootstrap any Application services.
     */
    public function boot(): void
    {
        //
    }
}
