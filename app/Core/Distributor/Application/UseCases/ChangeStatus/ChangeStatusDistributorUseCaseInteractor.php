<?php

namespace App\Core\Distributor\Application\UseCases\ChangeStatus;

use App\Concerns\StatusEntity;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;

class ChangeStatusDistributorUseCaseInteractor implements ChangeStatusDistributorUseCaseInterface
{
    public function __construct(private readonly DistributorRepositoryInterface    $distributorRepository){}

    public function changeStatus(int $id,StatusEntity $entity):void
    {
         $this->distributorRepository->changeStatus($id,$entity);
    }
}
