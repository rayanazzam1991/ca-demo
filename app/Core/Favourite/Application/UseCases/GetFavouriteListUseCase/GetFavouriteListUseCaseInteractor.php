<?php
namespace App\Core\Favourite\Application\UseCases\GetFavouriteListUseCase;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Favourite\Application\Repositories\FavouriteRepositoryInterface;
use App\Core\Favourite\Application\Repositories\GetFavouriteListGateWayRepositoryInterface;
use App\Core\Favourite\Application\UseCases\CreateFavourite\CreateFavouriteUseCaseInterface;
use App\Core\Favourite\Domain\Entities\FavouriteEntity;
use App\Core\Item\Application\Repositories\GetItemGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use Saloon\Exceptions\SaloonException;

class GetFavouriteListUseCaseInteractor implements GetFavouriteListUseCaseInterface
{
    public function __construct(private readonly FavouriteRepositoryInterface $favouriteRepository,
                                private readonly GetFavouriteListGateWayRepositoryInterface $favouriteListGateWayRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly GetFavouriteListOutputUseCaseInterface $favouriteListOutputUseCase

    ){}

    public function index()
    {
        $favourites = $this->favouriteRepository->index();
        ($favourites->count() != 0)?:throw new SaloonException(__('main.favourite_is_empty'),200);
        $distributor = $this->distributorRepository->show($favourites->first()->distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $data = $this->favouriteListGateWayRepository->getFavouriteList($favourites);
        return  $this->favouriteListOutputUseCase->getList(json_decode(json_encode($data),false),$distributor,$favourites->pluck('item_id')->toarray());
    }
}
