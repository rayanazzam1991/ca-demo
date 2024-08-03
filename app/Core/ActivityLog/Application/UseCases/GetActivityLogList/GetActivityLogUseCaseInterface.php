<?php
namespace App\Core\ActivityLog\Application\UseCases\GetActivityLogList;

use App\Core\ActivityLog\Application\Filter\ActivtyLogFilter;

interface GetActivityLogUseCaseInterface
{
    public function index(ActivtyLogFilter $filter);
}
