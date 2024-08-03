<?php

namespace App\Core\Shared\Region;

use App\Concerns\StatusEntity;
use Illuminate\Pagination\LengthAwarePaginator;

interface RegionRepositoryInterface
{
    public function index(RegionFilter $filter):LengthAwarePaginator;
    public function show(int $id):RegionModel;
    public function store(RegionEntity $entity):RegionModel;
    public function update(RegionEntity $entity,int $id):RegionModel;
    public function changeStatus(StatusEntity $entity,int $id):RegionModel;
}
