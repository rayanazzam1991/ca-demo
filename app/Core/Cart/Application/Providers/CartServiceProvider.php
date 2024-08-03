<?php
namespace App\Core\Cart\Application\Providers;

use App\Core\Cart\Application\Repositories\CartRepositoryInterface;
use App\Core\Cart\Application\UseCases\DeleteCart\DeleteCartUseCaseInteractor;
use App\Core\Cart\Application\UseCases\DeleteCart\DeleteCartUseCaseInterface;
use App\Core\Cart\Application\UseCases\GetCart\GetCartOutputUseCaseInterface;
use App\Core\Cart\Application\UseCases\GetCart\GetCartUseCaseInteractor;
use App\Core\Cart\Application\UseCases\GetCart\GetCartUseCaseInterface;
use App\Core\Cart\Infrastructure\Eloquent\CartRepository;
use App\Core\Cart\Presentation\Presenters\GetCartUseCaseResponse;
use App\Core\CartItem\Application\UseCases\DeleteCartItem\DeleteCartItemUseCaseInterface;
use App\Http\Controllers\V1\Cart\DeleteController;
use App\Http\Controllers\V1\Cart\ShowController;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {

        $this->app
        ->when(ShowController::class)
        ->needs(GetCartUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(GetCartUseCaseInteractor::class, [
                'output' =>$app->make(GetCartUseCaseResponse::class)
            ]);
        });

        $this->app
        ->when(DeleteController::class)
        ->needs(DeleteCartItemUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(DeleteCartUseCaseInteractor::class, [
            ]);
        });


        $this->app->bind(DeleteCartUseCaseInterface::class, DeleteCartUseCaseInteractor::class);
        $this->app->bind(GetCartOutputUseCaseInterface::class, GetCartUseCaseResponse::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
    }

    /**
     * Bootstrap any Application services.
     */
    public function boot(): void
    {
        //
    }
}
