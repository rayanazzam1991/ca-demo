<?php

namespace App\Core\Notification\Application\Repositories;


interface GetNotificationListGateWayRepositoryInterface
{
    public function index($phone_number,$user_type);
}
