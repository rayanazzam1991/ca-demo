<?php


use App\Concerns\BaseMapper;
use App\Core\Tenant\Domain\Entities\TenantEntity;
use App\Core\Tenant\Domain\Factories\TenantFactory;

class TenantMapper
{
    use BaseMapper;
    public static function fromRequest(array $request): TenantEntity
    {
        return  TenantFactory::new($request);
    }

}
