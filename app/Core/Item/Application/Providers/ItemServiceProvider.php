<?php

namespace App\Core\Item\Application\Providers;

use App\Core\Item\Application\Repositories\GetAlternativeItemListGateWayRepositoryInterface;
use App\Core\Item\Application\Repositories\GetItemGateWayRepositoryInterface;
use App\Core\Item\Application\Repositories\GetItemListGateWayRepositoryInterface;
use App\Core\Item\Application\Repositories\GetPopularItemListGateWayRepositoryInterface;
use App\Core\Item\Application\Repositories\GetPriceVariationItemListGateWayRepositoryInterface;
use App\Core\Item\Application\Repositories\SearchItemListGateWayRepositoryInterface;
use App\Core\Item\Application\UseCases\Alternative\GetAlternativeItemUseCaseInteractor;
use App\Core\Item\Application\UseCases\Alternative\GetAlternativeItemUseCaseInterface;
use App\Core\Item\Application\UseCases\GetList\GetItemsUseCaseInteractor;
use App\Core\Item\Application\UseCases\GetList\GetItemsUseCaseInterface;
use App\Core\Item\Application\UseCases\GetNotifyAlert\GetNotifyAlertUseCaseInteractor;
use App\Core\Item\Application\UseCases\GetNotifyAlert\GetNotifyAlertUseCaseInterface;
use App\Core\Item\Application\UseCases\GetOne\GetItemUseCaseInteractor;
use App\Core\Item\Application\UseCases\GetOne\GetItemUseCaseInterface;
use App\Core\Item\Application\UseCases\GetPopularList\GetPopularItemsUseCaseInterface;
use App\Core\Item\Application\UseCases\GetPopularList\GetPopularUseCaseOutputInterface;
use App\Core\Item\Application\UseCases\GetPriceVariationList\GetPriceVariationItemsUseCaseInteractor;
use App\Core\Item\Application\UseCases\GetPriceVariationList\GetPriceVariationItemsUseCaseInterface;
use App\Core\Item\Application\UseCases\GetPriceVariationList\GetPriceVariationUseCaseOutputInterface;
use App\Core\Item\Application\UseCases\Search\SearchItemsUseCaseInteractor;
use App\Core\Item\Application\UseCases\Search\SearchItemsUseCaseInterface;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway\GetAlternativeItemListGateway;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway\GetItemGateway;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway\GetItemListGateway;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway\GetPoupularItemListGateway;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway\GetPriceVariationItemListGateway;
use App\Core\Item\Infrastructure\SharedSystem\Integration\Gateway\SearchItemListGateway;
use App\Core\Item\Presentation\Presenters\GetAlternaticeItemsUseCaseResponse;
use App\Core\Item\Presentation\Presenters\GetItemsUseCaseResponse;
use App\Core\Item\Presentation\Presenters\GetItemUseCaseResponse;
use App\Core\Item\Presentation\Presenters\GetPopularItemsUseCaseResponse;
use App\Core\Item\Presentation\Presenters\GetPriceVariationItemsUseCaseResponse;
use App\Core\Item\Presentation\Presenters\SearchItemsUseCaseResponse;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use App\Core\Tenant\Infrastructure\Eloquent\TenantRepository;
use App\Http\Controllers\V1\Item\GetAlternativeController;
use App\Http\Controllers\V1\Item\GetNotifyAlertController;
use App\Http\Controllers\V1\Item\GetPoupularController;
use App\Http\Controllers\V1\Item\GetPriceVariationController;
use App\Http\Controllers\V1\Item\IndexController;
use App\Http\Controllers\V1\Item\SearchController;
use App\Http\Controllers\V1\Item\ShowController;
use Illuminate\Support\ServiceProvider;



class ItemServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app
            ->when(IndexController::class)
            ->needs(GetItemsUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetItemsUseCaseInteractor::class, [
                    'output' => $app->make(GetItemsUseCaseResponse::class),
                ]);
            });
        $this->app
            ->when(ShowController::class)
            ->needs(GetItemUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetItemUseCaseInteractor::class, [
                    'output' => $app->make(GetItemUseCaseResponse::class),
                ]);
            });

        $this->app
        ->when(GetAlternativeController::class)
        ->needs(GetAlternativeItemUseCaseInterface::class)
        ->give(function ($app) {
            return $app->make(GetAlternativeItemUseCaseInteractor::class, [
                'output' => $app->make(GetAlternaticeItemsUseCaseResponse::class),
            ]);
        });

        $this->app
            ->when(GetPriceVariationController::class)
            ->needs(GetPriceVariationItemsUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetPriceVariationItemsUseCaseInteractor::class, [
                    'output' => $app->make(GetPriceVariationItemsUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(SearchController::class)
            ->needs(SearchItemsUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(SearchItemsUseCaseInteractor::class, [
                    'output' => $app->make(SearchItemsUseCaseResponse::class),
                ]);
            });

        $this->app
            ->when(GetPoupularController::class)
            ->needs(GetPopularItemsUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetPopularItemsUseCaseInterface::class, [
                    'output' => $app->make(GetPopularItemsUseCaseResponse::class),
                ]);
            });
        $this->app
            ->when(GetNotifyAlertController::class)
            ->needs(GetNotifyAlertUseCaseInterface::class)
            ->give(function ($app) {
                return $app->make(GetNotifyAlertUseCaseInteractor::class, []);
            });

        $this->app->bind(GetPopularUseCaseOutputInterface::class, GetPopularItemsUseCaseResponse::class);
        $this->app->bind(SearchItemListGateWayRepositoryInterface::class, SearchItemListGateway::class);
        $this->app->bind(GetPopularItemListGateWayRepositoryInterface::class, GetPoupularItemListGateway::class);
        $this->app->bind(GetPriceVariationItemListGateWayRepositoryInterface::class, GetPriceVariationItemListGateway::class);
        $this->app->bind(GetAlternativeItemListGateWayRepositoryInterface::class, GetAlternativeItemListGateway::class);
        $this->app->bind(TenantRepositoryInterface::class, TenantRepository::class);
        $this->app->bind(GetItemListGateWayRepositoryInterface::class, GetItemListGateway::class);
        $this->app->bind(GetItemGateWayRepositoryInterface::class, GetItemGateway::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
