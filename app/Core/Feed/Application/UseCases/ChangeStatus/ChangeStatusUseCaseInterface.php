<?php

namespace App\Core\Feed\Application\UseCases\ChangeStatus;

use App\Concerns\StatusEntity;

interface ChangeStatusUseCaseInterface
{
    public function ChangeStatus(StatusEntity $entity,int $id):void;
}
