<?php

namespace App\Core\Task\Application\Repositories;

interface GetPackageGateWayRepositoryInterface
{
    public function show($domain,$package_id);
}
