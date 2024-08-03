<?php

namespace App\Core\Shared\City;

use App\Concerns\BaseFilter;
use App\Concerns\StatusEntity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CityUseCaseInterface
{
    public function index(CityFilter $filter);
    public function show(int $id);
    public function store(CityEntity $entity):void;
    public function update(CityEntity $entity,int $id):void;
    public function changeStatus(StatusEntity $entity,int $id):void;
}
