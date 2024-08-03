<?php

namespace App\Core\ActivityLog\Application\Repositories;

use App\Core\ActivityLog\Application\Filter\ActivtyLogFilter;

interface ActivityLogRepositoryInterface
{
    public function index(ActivtyLogFilter $filter);

}
