<?php

namespace App\Core\Shared\Region;

use App\Concerns\StatusEntity;

interface RegionUseCaseInterface
{
    public function index(RegionFilter $filter);
    public function show(int $id);
    public function store(RegionEntity $entity):void;
    public function update(RegionEntity $entity,int $id):void;
    public function changeStatus(StatusEntity $entity,int $id):void;
}
