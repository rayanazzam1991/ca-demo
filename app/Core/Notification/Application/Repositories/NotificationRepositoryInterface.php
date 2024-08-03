<?php

namespace App\Core\Notification\Application\Repositories;

use App\Core\Notification\Application\Filter\NotificationFilter;
use App\Core\Notification\Domain\Entities\NotificationEntity;
use App\Core\Notification\Infrastructure\Eloquent\NotificationModel;
use Illuminate\Pagination\LengthAwarePaginator;

interface NotificationRepositoryInterface
{
    public function index(NotificationFilter $filter):LengthAwarePaginator;
    public function store(NotificationEntity $entity):NotificationModel;
}
