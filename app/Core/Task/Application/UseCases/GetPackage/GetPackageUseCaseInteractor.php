<?php
namespace App\Core\Task\Application\UseCases\GetPackage;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Task\Application\Repositories\GetPackageGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class GetPackageUseCaseInteractor implements GetPackageUseCaseInterface
{
    public function __construct(private readonly GetPackageGateWayRepositoryInterface $repository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly GetPackageOutUseCaseInterface $outUseCase
){}

    public function show($id,$distributor_id)
    {
        $distributor = $this->distributorRepository->show($distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $data = $this->repository->show($tenant->local_domain,$id);
        return $this->outUseCase->show(json_decode(json_encode($data),false),$distributor);
    }
}
