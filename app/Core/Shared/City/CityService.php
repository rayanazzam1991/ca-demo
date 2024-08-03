<?php

namespace App\Core\Shared\City;

use App\Concerns\StatusEntity;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CityService implements CityUseCaseInterface
{
    public function __construct(private readonly CityRepositoryInterface      $cityRepository,
                                private readonly TenantRepositoryInterface  $tenantRepository,
                                private readonly SyncCityGateWayRepositoryInterface  $gateWayRepository,
                                private readonly CityUseCaseOutputInterface $output){}

    public function index(CityFilter $filter)
    {
        return $this->output->index($this->cityRepository->index($filter));
    }
    public function show(int $id)
    {
        return $this->output->show($this->cityRepository->show($id));
    }
    public function store(CityEntity $entity):void
    {
        try {
            DB::beginTransaction();
            $city = $this->cityRepository->store($entity);
            $this->gateWayRepository->sync(CityMapper::fromRequest(array_merge(['status' =>1],$city->toArray())));
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
    }
    public function update(CityEntity $entity,int $id):void
    {
        try {
            DB::beginTransaction();
            $city = $this->cityRepository->update($entity,$id);
            $this->gateWayRepository->sync(CityMapper::fromRequest($city->toArray()));
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
    }
    public function changeStatus(StatusEntity $entity,int $id):void
    {
        try {
            DB::beginTransaction();
            $city = $this->cityRepository->changeStatus($entity,$id);
            $this->gateWayRepository->sync(CityMapper::fromRequest($city->toArray()));
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
    }
}
