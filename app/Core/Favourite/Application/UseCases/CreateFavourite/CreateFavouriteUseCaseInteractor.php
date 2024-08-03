<?php
namespace App\Core\Favourite\Application\UseCases\CreateFavourite;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Favourite\Application\Repositories\FavouriteRepositoryInterface;
use App\Core\Favourite\Domain\Entities\FavouriteEntity;
use App\Core\Item\Application\Repositories\GetItemGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class CreateFavouriteUseCaseInteractor implements CreateFavouriteUseCaseInterface
{
    public function __construct(private readonly FavouriteRepositoryInterface $favouriteRepository,
                                private readonly GetItemGateWayRepositoryInterface $itemGateWayRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly DistributorRepositoryInterface $distributorRepository,

    ){}

    public function store(FavouriteEntity $entity)
    {
        $tenant_id = $this->distributorRepository->show($entity->distributor_id)->tenant_id;
        $tenant = $this->tenantRepository->getById($tenant_id);
        $this->itemGateWayRepository->getItem($tenant->local_domain,$entity->item_id)['data'];
        return $this->favouriteRepository->sync($entity);
    }
}
