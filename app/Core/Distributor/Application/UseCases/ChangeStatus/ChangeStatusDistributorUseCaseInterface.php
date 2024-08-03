<?php

namespace App\Core\Distributor\Application\UseCases\ChangeStatus;

use App\Concerns\StatusEntity;

interface ChangeStatusDistributorUseCaseInterface
{
    public function changeStatus(int $id,StatusEntity $entity):void;

}
