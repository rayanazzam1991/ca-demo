<?php

namespace App\Core\Auth;


use App\Http\Controllers\V1\Auth\AdminLoginController;
use App\Http\Controllers\V1\Auth\DeleteAccountController;
use App\Http\Controllers\V1\Auth\DeleteDeliveryAccountController;
use App\Http\Controllers\V1\Auth\SendCodeController;
use App\Http\Controllers\V1\Auth\StoreDeliveryFcmTokenController;
use App\Http\Controllers\V1\Auth\StoreFcmTokenController;
use App\Http\Controllers\V1\Auth\VerifyCodeController;
use App\Http\Controllers\V1\User\IndexController;
use Illuminate\Support\ServiceProvider;

class LoginServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(LoginUseCase::class,
//            LoginService::class);

        $this->app
            ->when(VerifyCodeController::class)
            ->needs(LoginUseCase::class)
            ->give(function ($app) {
                return $app->make(LoginService::class, [
                    'output' => $app->make(LoginUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(SendCodeController::class)
            ->needs(LoginUseCase::class)
            ->give(function ($app) {
                return $app->make(LoginService::class, [
                    'output' => $app->make(LoginUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(AdminLoginController::class)
            ->needs(LoginUseCase::class)
            ->give(function ($app) {
                return $app->make(LoginService::class, [
                    'output' => $app->make(LoginUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(StoreFcmTokenController::class)
            ->needs(LoginUseCase::class)
            ->give(function ($app) {
                return $app->make(LoginService::class, [
                    'output' => $app->make(LoginUseCaseResponse::class),
                ]);
            });
        $this->app
            ->when(StoreDeliveryFcmTokenController::class)
            ->needs(LoginUseCase::class)
            ->give(function ($app) {
                return $app->make(LoginService::class, [
                    'output' => $app->make(LoginUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(IndexController::class)
            ->needs(LoginUseCase::class)
            ->give(function ($app) {
                return $app->make(LoginService::class, [
                    'output' => $app->make(LoginUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(DeleteAccountController::class)
            ->needs(LoginUseCase::class)
            ->give(function ($app) {
                return $app->make(LoginService::class, [
                    'output' => $app->make(LoginUseCaseResponse::class),
                ]);
            });
        $this->app
            ->when(DeleteDeliveryAccountController::class)
            ->needs(LoginUseCase::class)
            ->give(function ($app) {
                return $app->make(LoginService::class, [
                    'output' => $app->make(LoginUseCaseResponse::class),
                ]);
            });

        $this->app->bind(DeactivateStatusGateWayRepositoryInterface::class, DeactivateUserGateway::class);
        $this->app->bind(LoginRepositoryInterface::class, UserCodeRepository::class);
        $this->app->bind(LoginUseCaseOutput::class, LoginUseCaseResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
