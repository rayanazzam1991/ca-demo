<?php

namespace App\Core\Shared\City;

use App\Concerns\BaseFilter;
use App\Concerns\StatusEntity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CityRepositoryInterface
{
    public function index(CityFilter $filter):LengthAwarePaginator;
    public function show(int $id):CityModel;
    public function store(CityEntity $entity):CityModel;
    public function update(CityEntity $entity,int $id):CityModel;
    public function changeStatus(StatusEntity $entity,int $id):CityModel;
}
