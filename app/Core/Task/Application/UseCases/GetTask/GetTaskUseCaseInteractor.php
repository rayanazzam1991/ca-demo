<?php
namespace App\Core\Task\Application\UseCases\GetTask;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Task\Application\Repositories\GetTaskGateWayRepositoryInterface;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class GetTaskUseCaseInteractor implements GetTaskUseCaseInterface
{
    public function __construct(private readonly GetTaskGateWayRepositoryInterface $repository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
                                private readonly GetTaskOutUseCaseInterface $outUseCase
){}

    public function show($id,$distributor_id)
    {
        $distributor = $this->distributorRepository->show($distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $data = $this->repository->show($tenant->local_domain,$id);
        return $this->outUseCase->show(json_decode(json_encode($data),false),$distributor);
    }
}
