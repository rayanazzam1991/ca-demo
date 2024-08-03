<?php

namespace App\Core\Notification\Application\Providers;

use App\Core\Notification\Application\Repositories\GetNotificationListGateWayRepositoryInterface;
use App\Core\Notification\Application\Repositories\NotificationRepositoryInterface;
use App\Core\Notification\Application\Repositories\SyncFcmGateWayRepositoryInterface;
use App\Core\Notification\Application\UseCases\CreateNotification\CreateNotificationUseCaseInteractor;
use App\Core\Notification\Application\UseCases\CreateNotification\CreateNotificationUseCaseInterface;
use App\Core\Notification\Application\UseCases\GetNotificationList\GetNotificationListOutUseCaseInterface;
use App\Core\Notification\Application\UseCases\GetNotificationList\GetNotificationListUseCaseInteractor;
use App\Core\Notification\Application\UseCases\GetNotificationList\GetNotificationListUseCaseInterface;
use App\Core\Notification\Application\UseCases\GetUserNotificationList\GetUserNotificationListUseCaseInteractor;
use App\Core\Notification\Application\UseCases\GetUserNotificationList\GetUserNotificationListUseCaseInterface;
use App\Core\Notification\Application\UseCases\InformNotification\InformNotificationUseCaseInteractor;
use App\Core\Notification\Application\UseCases\InformNotification\InformNotificationUseCaseInterface;
use App\Core\Notification\Infrastructure\Eloquent\NotificationRepository;
use App\Core\Notification\Infrastructure\SharedSystem\Integration\Gateway\GetNotificationListGateway;
use App\Core\Notification\Infrastructure\SharedSystem\Integration\Gateway\SyncFcmGateway;
use App\Core\Notification\Presentation\Presenters\GetNotificationListUseCaseResponse;
use App\Http\Controllers\V1\Notification\GetDeliveryManNotificationController;
use App\Http\Controllers\V1\Notification\GetPharmacyNotificationController;
use App\Http\Controllers\V1\Notification\IndexController;
use App\Http\Controllers\V1\Notification\InformController;
use App\Http\Controllers\V1\Notification\StoreController;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app
        ->when(IndexController::class)
        ->needs(GetNotificationListUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(GetNotificationListUseCaseInteractor::class, []);
        });
        $this->app
        ->when(StoreController::class)
        ->needs(CreateNotificationUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(CreateNotificationUseCaseInteractor::class, []);
        });
        $this->app
        ->when(GetPharmacyNotificationController::class)
        ->needs(GetUserNotificationListUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(GetUserNotificationListUseCaseInteractor::class, []);
        });
        $this->app
        ->when(GetDeliveryManNotificationController::class)
        ->needs(GetUserNotificationListUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(GetUserNotificationListUseCaseInteractor::class, []);
        });
        $this->app
        ->when(InformController::class)
        ->needs(InformNotificationUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(InformNotificationUseCaseInteractor::class, []);
        });

        $this->app->bind(NotificationRepositoryInterface::class,NotificationRepository::class);
        $this->app->bind(GetNotificationListOutUseCaseInterface::class,GetNotificationListUseCaseResponse::class);
        $this->app->bind(SyncFcmGateWayRepositoryInterface::class,SyncFcmGateway::class);
        $this->app->bind(GetNotificationListGateWayRepositoryInterface::class,GetNotificationListGateway::class);
    }

    /**
     * Bootstrap any Application services.
     */
    public function boot(): void
    {
        //
    }
}
