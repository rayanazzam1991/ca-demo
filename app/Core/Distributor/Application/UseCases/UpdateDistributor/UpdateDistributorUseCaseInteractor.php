<?php

namespace App\Core\Distributor\Application\UseCases\UpdateDistributor;

use App\Core\Distributor\Application\Mappers\DistributorMapper;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Distributor\Application\Repositories\UpdateDistributorGateWayRepositoryInterface;
use App\Core\Distributor\Domain\Entities\DistributorEntity;
use App\Core\Media\MediaService;
use App\Core\Shared\Address\AddressRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use App\Enums\MediaModelsEnum;
use Illuminate\Support\Facades\DB;

class UpdateDistributorUseCaseInteractor implements UpdateDistributorUseCaseInterface
{
    public function __construct(private readonly DistributorRepositoryInterface    $distributorRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly MediaService    $mediaService,
                                private readonly AddressRepositoryInterface    $addressRepository,
                                private readonly UpdateDistributorGateWayRepositoryInterface $updateDistributor,
    ){}

    public function update(int $id,DistributorEntity $distributorEntity):void
    {
        try {
            DB::beginTransaction();
            $distributor = $this->distributorRepository->update($id,$distributorEntity);
            $tenant = $this->tenantRepository->getById($distributor->tenant_id);
            $this->addressRepository->update($distributor->address_id,$distributorEntity->address);
            if($distributorEntity->remove_image && isset($distributor->medias))$this->mediaService->destroy($distributor->medias?->id);
            !isset($distributorEntity->image) ?: $this->mediaService->store($distributor->id, MediaModelsEnum::distributor->value, $distributorEntity->image);
            $this->updateDistributor->update(DistributorMapper::fromRequest($this->distributorRepository->show($id)->toArray(),$distributorEntity->image),$tenant->local_domain);
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
