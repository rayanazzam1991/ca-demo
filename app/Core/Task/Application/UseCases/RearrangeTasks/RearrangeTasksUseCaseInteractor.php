<?php

namespace App\Core\Task\Application\UseCases\RearrangeTasks;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Task\Application\Repositories\RearrangeTasksGatewayRepositoryInterface;
use App\Core\Task\Domain\Entities\RearrangeTasksEntity;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;

class RearrangeTasksUseCaseInteractor implements RearrangeTasksUseCaseInterface
{
    public function __construct(
        private readonly RearrangeTasksGatewayRepositoryInterface $repository,
        private readonly DistributorRepositoryInterface $distributorRepository,
        private readonly TenantRepositoryInterface $tenantRepository,

    ) {
    }
    public function rearrange(RearrangeTasksEntity $data)
    {
        $deliveryNumber = auth()->guard('delivery')->user()->phone_number;
        $formattedDataTasks = [];
        foreach ($data->tasks as $task) {
            $distributor = $this->distributorRepository->show($task['distributor_id']);
            $formattedDataTasks[] = [
                'task_id' => $task['task_id'],
                'tenant_id' => $distributor->tenant_id
            ];
        }

        $this->repository->rearrange($formattedDataTasks, $deliveryNumber);
    }
}
