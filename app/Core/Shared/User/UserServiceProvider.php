<?php

namespace App\Core\Shared\User;

use App\Http\Controllers\V1\Pharmacy\GetPharmacyController;
use App\Http\Controllers\V1\User\DeliverySignOutController;
use App\Http\Controllers\V1\User\EditProfileController;
use App\Http\Controllers\V1\User\SignOutController;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app
        ->when(SignOutController::class)
        ->needs(UserUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(UserService::class, [
                'output' => $app->make(UserUseCaseResponse::class),
            ]);
        });

        $this->app
        ->when(DeliverySignOutController::class)
        ->needs(UserUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(UserService::class, [
                'output' => $app->make(UserUseCaseResponse::class),
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
