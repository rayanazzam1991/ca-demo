<?php

namespace App\Core\Distributor\Application\Repositories;

use App\Concerns\BaseFilter;
use App\Concerns\StatusEntity;
use App\Core\Distributor\Application\Filter\DistributorFilter;
use App\Core\Distributor\Domain\Entities\DistributorEntity;
use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface DistributorRepositoryInterface
{
    public function index(DistributorFilter $filter):LengthAwarePaginator;
    public function show(int $id):Model;
    public function store(DistributorEntity $distributorEntity,int $address_id,int $tenant_id):DistributorModel;
    public function update(int $id,DistributorEntity $distributorEntity):DistributorModel;
    public function changeStatus(int $id,StatusEntity $entity):void;
    public function getListForDeliveryMan(DistributorFilter $filter , ?int $distributorId );

}
