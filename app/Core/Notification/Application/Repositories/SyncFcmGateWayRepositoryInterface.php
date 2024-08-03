<?php

namespace App\Core\Notification\Application\Repositories;

use App\Core\Notification\Domain\Entities\FcmEntity;

interface SyncFcmGateWayRepositoryInterface
{
    public function sync(FcmEntity $entity);
}
