<?php
namespace App\Core\CartItem\Application\Providers;

use App\Core\Cart\Application\Repositories\CartRepositoryInterface;
use App\Core\Cart\Infrastructure\Eloquent\CartRepository;
use App\Core\CartItem\Application\Repositories\CartItemRepositoryInterface;
use App\Core\CartItem\Application\UseCases\CreateCartItem\CreateCartItemUseCaseInteractor;
use App\Core\CartItem\Application\UseCases\CreateCartItem\CreateCartItemUseCaseInterface;
use App\Core\CartItem\Application\UseCases\DeleteCartItem\DeleteCartItemUseCaseInteractor;
use App\Core\CartItem\Application\UseCases\DeleteCartItem\DeleteCartItemUseCaseInterface;
use App\Core\CartItem\Infrastructure\Eloquent\CartItemRepository;
use App\Core\Item\Application\Repositories\GetItemGateWayRepositoryInterface;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway\GetItemGateway;
use App\Http\Controllers\V1\CartItem\DestroyController;
use App\Http\Controllers\V1\CartItem\StoreController;
use Illuminate\Support\ServiceProvider;

class CartItemServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app
            ->when(StoreController::class)
            ->needs(CreateCartItemUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CreateCartItemUseCaseInteractor::class, [

                ]);
            });

        $this->app
            ->when(DestroyController::class)
            ->needs(DeleteCartItemUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(DeleteCartItemUseCaseInteractor::class, [

                ]);
            });

        $this->app->bind(CartItemRepositoryInterface::class, CartItemRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(GetItemGateWayRepositoryInterface::class,GetItemGateway::class);
    }

    /**
     * Bootstrap any Application services.
     */
    public function boot(): void
    {
        //
    }
}
