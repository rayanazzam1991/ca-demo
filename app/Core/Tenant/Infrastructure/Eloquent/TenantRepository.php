<?php

namespace App\Core\Tenant\Infrastructure\Eloquent;

use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use App\Core\Tenant\Domain\Entities\TenantEntity;


class TenantRepository implements TenantRepositoryInterface
{
    public function getById($id):TenantModel
    {
        return TenantModel::where('id',$id)->firstOrFail();
    }

    public function getCount():int
    {
        return TenantModel::query()->count();
    }
    public function store(TenantEntity $entity):TenantModel
    {
        return TenantModel::create([
            'database'=>str_replace(' ','_',$entity->database),
            'domain' =>str_replace(' ','_',$entity->domain),
            'local_domain' => str_replace(' ','_',$entity->local_domain),
            'name' => $entity->name
        ]);
    }
}
