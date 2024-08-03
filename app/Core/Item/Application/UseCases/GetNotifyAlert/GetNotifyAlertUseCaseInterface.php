<?php

namespace App\Core\Item\Application\UseCases\GetNotifyAlert;

use App\Core\Item\Domain\Entities\NotifyEntity;

interface GetNotifyAlertUseCaseInterface
{
    public function getNotifyAlert(NotifyEntity $entity);
}
