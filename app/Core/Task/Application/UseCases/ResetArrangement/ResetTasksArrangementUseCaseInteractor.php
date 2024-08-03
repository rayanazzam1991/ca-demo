<?php

namespace App\Core\Task\Application\UseCases\ResetArrangement;

use App\Core\Task\Application\Repositories\ResetTasksArrangementGatewayRepositoryInterface;

class ResetTasksArrangementUseCaseInteractor implements ResetTasksArrangementUseCaseInterface
{
    public function __construct(
        private readonly ResetTasksArrangementGatewayRepositoryInterface $repository,
    ) {
    }

    public function reset()
    {
        $deliveryNumber = auth()->guard('delivery')->user()->phone_number;
        $this->repository->reset($deliveryNumber);
    }
}
