<?php

namespace App\Core\Tenant\Application\Repositories;

use App\Core\Tenant\Domain\Entities\TenantEntity;
use App\Core\Tenant\Infrastructure\Eloquent\TenantModel;

interface TenantRepositoryInterface
{
    public function getById($id):TenantModel;
    public function store(TenantEntity $entity):TenantModel;
    public function getCount():int;
}
