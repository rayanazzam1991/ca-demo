<?php
namespace App\Core\Notification\Application\UseCases\GetUserNotificationList;

interface GetUserNotificationListUseCaseInterface
{
    public function index($phone_number,$user_type);
}
