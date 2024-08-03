<?php

namespace App\Core\Shared\Region;

use App\Concerns\StatusEntity;
use App\Core\Shared\City\CityMapper;
use App\Core\Shared\City\SyncCityGateWayRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RegionService implements RegionUseCaseInterface
{
    public function __construct(private readonly RegionRepositoryInterface      $regionRepository,
                                private readonly SyncRegionGateWayRepositoryInterface $gateWayRepository,
                                private readonly RegionUseCaseOutputInterface $output){}

    public function index(RegionFilter $filter)
    {
        return $this->output->index($this->regionRepository->index($filter));
    }
    public function show(int $id)
    {
        return $this->output->show($this->regionRepository->show($id));
    }
    public function store(RegionEntity $entity):void
    {
        try {
            DB::beginTransaction();
            $region = $this->regionRepository->store($entity);
            $this->gateWayRepository->sync(RegionMapper::fromRequest(array_merge($region->toArray(),['status'=>1])));
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
    }
    public function update(RegionEntity $entity,int $id):void
    {
        try {
            DB::beginTransaction();
            $region =$this->regionRepository->update($entity,$id);
            $this->gateWayRepository->sync(RegionMapper::fromRequest(array_merge($region->toArray(),['status'=>1])));
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
            $region =$this->regionRepository->changeStatus($entity,$id);
            $this->gateWayRepository->sync(RegionMapper::fromRequest(array_merge($region->toArray(),['status'=>1])));
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
            throw $exception;
        }
    }
}
