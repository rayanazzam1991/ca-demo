<?php
namespace App\Core\Task\Application\UseCases\ChangeStatusTask;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Task\Application\Repositories\TaskChangeStatusGateWayRepositoryInterface;
use App\Core\Task\Domain\Entities\TaskStatusEntity;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class ChangeStatusTaskUseCaseInteractor implements ChangeStatusTaskUseCaseInterface
{
    public function __construct(private readonly TaskChangeStatusGateWayRepositoryInterface $repository,
                                private readonly DistributorRepositoryInterface $distributorRepository,
                                private readonly TenantRepositoryInterface $tenantRepository,
){}

    public function changeStatus(TaskStatusEntity $entity,$distributor_id)
    {
        $distributor = $this->distributorRepository->show($distributor_id);
        $tenant = $this->tenantRepository->getById($distributor->tenant_id);
        $this->repository->changeStatus($entity,$tenant->local_domain);
    }
}
