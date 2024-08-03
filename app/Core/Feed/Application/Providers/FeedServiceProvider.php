<?php
namespace App\Core\Feed\Application\Providers;

use App\Core\Distributor\Application\Repositories\GetDistributorCategoryGateWayRepositoryInterface;
use App\Core\Distributor\Infrastructure\Integration\SharedSystem\Gateway\GetDistributorCategoryGateway;
use App\Core\Feed\Application\Repositories\FeedRepositoryInterface;
use App\Core\Feed\Application\Repositories\GetUpdateListGateWayRepositoryInterface;
use App\Core\Feed\Application\UseCases\ChangeStatus\ChangeStatusUseCaseInteractor;
use App\Core\Feed\Application\UseCases\ChangeStatus\ChangeStatusUseCaseInterface;
use App\Core\Feed\Application\UseCases\CreateFeed\CreateFeedUseCaseInteractor;
use App\Core\Feed\Application\UseCases\CreateFeed\CreateFeedUseCaseInterface;
use App\Core\Feed\Application\UseCases\GetList\GetListFeedUseCaseInteractor;
use App\Core\Feed\Application\UseCases\GetList\GetListFeedUseCaseInterface;
use App\Core\Feed\Application\UseCases\GetList\GetListFeedUseCaseOutputInterface;
use App\Core\Feed\Application\UseCases\GetUpdateList\GetListUpdateUseCaseOutputInterface;
use App\Core\Feed\Application\UseCases\GetOne\GetOneFeedUseCaseInteractor;
use App\Core\Feed\Application\UseCases\GetOne\GetOneFeedUseCaseInterface;
use App\Core\Feed\Application\UseCases\GetOne\GetOneFeedUseCaseOutputInterface;
use App\Core\Feed\Application\UseCases\GetUpdateList\GetListUpdateUseCaseInteractor;
use App\Core\Feed\Application\UseCases\GetUpdateList\GetListUpdateUseCaseInterface;
use App\Core\Feed\Application\UseCases\UpdateFeed\UpdateFeedUseCaseInteractor;
use App\Core\Feed\Application\UseCases\UpdateFeed\UpdateFeedUseCaseInterface;
use App\Core\Feed\Infrastructure\Eloquent\FeedRepository;
use App\Core\Feed\Presentation\Presenters\GetListFeedUseCaseResponse;
use App\Core\Feed\Presentation\Presenters\GetListUpdateUseCaseResponse;
use App\Core\Feed\Presentation\Presenters\GetOneFeedUseCaseResponse;
use App\Core\Feed\Infrastructure\SharedSystem\Integration\Gateway\GetUpdateListGateway;
use App\Core\Reminder\Application\UseCases\CreateReminder\CreateReminderUseCaseInteractor;
use App\Http\Controllers\V1\Feed\ChangeStatusController;
use App\Http\Controllers\V1\Feed\GetUpdateListController;
use App\Http\Controllers\V1\Feed\IndexController;
use App\Http\Controllers\V1\Feed\ShowController;
use App\Http\Controllers\V1\Feed\StoreController;
use App\Http\Controllers\V1\Feed\UpdateController;
use Illuminate\Support\ServiceProvider;

class FeedServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app
        ->when(IndexController::class)
        ->needs(GetListFeedUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(GetListFeedUseCaseInteractor::class, [
                'output' => $app->make(GetListFeedUseCaseOutputInterface::class),
            ]);
        });

        $this->app
        ->when(ShowController::class)
        ->needs(GetOneFeedUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(GetOneFeedUseCaseInteractor::class, [
                'output' => $app->make(GetOneFeedUseCaseOutputInterface::class),
            ]);
        });

        $this->app
        ->when(StoreController::class)
        ->needs(CreateFeedUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(CreateFeedUseCaseInteractor::class, []);
        });

        $this->app
        ->when(UpdateController::class)
        ->needs(UpdateFeedUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(UpdateFeedUseCaseInteractor::class, []);
        });

        $this->app
        ->when(ChangeStatusController::class)
        ->needs(ChangeStatusUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(ChangeStatusUseCaseInteractor::class, []);
        });

        $this->app
        ->when(GetUpdateListController::class)
        ->needs(GetListUpdateUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(GetListUpdateUseCaseInteractor::class, [
                'output' => $app->make(GetListUpdateUseCaseOutputInterface::class),
            ]);
        });

        $this->app->bind(GetOneFeedUseCaseOutputInterface::class, GetOneFeedUseCaseResponse::class);
        $this->app->bind(GetListUpdateUseCaseOutputInterface::class, GetListUpdateUseCaseResponse::class);
        $this->app->bind(GetUpdateListGateWayRepositoryInterface::class, GetUpdateListGateway::class);
        $this->app->bind(GetListFeedUseCaseOutputInterface::class, GetListFeedUseCaseResponse::class);
        $this->app->bind(GetListFeedUseCaseInteractor::class, GetListFeedUseCaseInteractor::class);
        $this->app->bind(FeedRepositoryInterface::class,FeedRepository::class);
    }

    /**
     * Bootstrap any Application services.
     */
    public function boot(): void
    {
        //
    }
}
