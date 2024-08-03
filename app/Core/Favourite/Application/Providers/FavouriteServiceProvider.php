<?php
namespace App\Core\Favourite\Application\Providers;

use App\Core\Favourite\Application\Repositories\FavouriteRepositoryInterface;
use App\Core\Favourite\Application\Repositories\GetFavouriteListGateWayRepositoryInterface;
use App\Core\Favourite\Application\UseCases\CreateFavourite\CreateFavouriteUseCaseInteractor;
use App\Core\Favourite\Application\UseCases\CreateFavourite\CreateFavouriteUseCaseInterface;
use App\Core\Favourite\Application\UseCases\GetFavouriteListUseCase\GetFavouriteListOutputUseCaseInterface;
use App\Core\Favourite\Application\UseCases\GetFavouriteListUseCase\GetFavouriteListUseCaseInteractor;
use App\Core\Favourite\Application\UseCases\GetFavouriteListUseCase\GetFavouriteListUseCaseInterface;
use App\Core\Favourite\Infrastructure\Eloquent\FavouriteRepository;
use App\Core\Favourite\Infrastructure\SharedSystem\Integration\Gateway\FavouriteListGateway;
use App\Core\Favourite\Presentation\Presenters\GetFavouriteListUseCaseResponse;
use App\Http\Controllers\V1\Favourite\IndexController;
use App\Http\Controllers\V1\Favourite\StoreController;
use Illuminate\Support\ServiceProvider;

class FavouriteServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app
            ->when(StoreController::class)
            ->needs(CreateFavouriteUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(CreateFavouriteUseCaseInteractor::class, []);
            });

        $this->app
            ->when(IndexController::class)
            ->needs(GetFavouriteListUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetFavouriteListUseCaseInteractor::class, [
                    'output' => $app->make(GetFavouriteListOutputUseCaseInterface::class)
                ]);
            });

        $this->app->bind(FavouriteRepositoryInterface::class, FavouriteRepository::class);
        $this->app->bind(GetFavouriteListOutputUseCaseInterface::class, GetFavouriteListUseCaseResponse::class);
        $this->app->bind(GetFavouriteListGateWayRepositoryInterface::class, FavouriteListGateway::class);

    }

    /**
     * Bootstrap any Application services.
     */
    public function boot(): void
    {
        //
    }
}
