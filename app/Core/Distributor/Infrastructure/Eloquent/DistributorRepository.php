<?php

namespace App\Core\Distributor\Infrastructure\Eloquent;

use App\Concerns\StatusEntity;
use App\Core\Distributor\Application\Filter\DistributorFilter;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Distributor\Domain\Entities\DistributorEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;


class DistributorRepository implements DistributorRepositoryInterface
{
    public function index(DistributorFilter $filter): LengthAwarePaginator
    {

        return DistributorModel::with(['address', 'medias', 'createdUser', 'tenant'])
            ->when($filter->search, function ($q) use ($filter) {
                return $q
                    ->where('name_en', 'like', '%' . $filter->search . '%')
                    ->orWhere('name_ar', 'like', '%' . $filter->search . '%')
                    ->orWhere('id', 'like', '%' . $filter->search . '%')
                    ->orWhere('phone_number', 'like', '%' . $filter->search . '%');
            })
            ->when($filter->name_ar, function ($q) use ($filter) {
                return $q->where('name_ar', 'like', '%' . $filter->name_ar . '%');
            })
            ->when($filter->name_en, function ($q) use ($filter) {
                return $q->where('name_en', 'like', '%' . $filter->name_en . '%');
            })
            ->when(isset($filter->type), function ($q) use ($filter) {
                return $q->whereHas('subscriptions', function ($query) use ($filter) {
                    return $query->where('type', $filter->type);
                });
            })
            ->when(isset($filter->status), function ($q) use ($filter) {
                return $q->where('status', $filter->status);
            })
            ->when(isset($filter->order), function ($q) use ($filter) {
                return $q->orderBy('created_at', $filter->order);
            })
            ->paginate($filter->per_page);
    }

    public function show(int $id): Model
    {
        return DistributorModel::with(['address', 'medias', 'tenant'])->whereId($id)->firstOrFail();
    }

    public function store(DistributorEntity $distributorEntity, int $address_id, int $tenant_id): DistributorModel
    {
        return DistributorModel::create(array_merge($distributorEntity->toArray(), ['address_id' => $address_id, 'tenant_id' => $tenant_id]));
    }

    public function update(int $id, DistributorEntity $distributorEntity): DistributorModel
    {

        $distributor = DistributorModel::whereId($id)->firstOrFail();
        $distributor->update(array_filter($distributorEntity->toArray(), function ($value) {
            return $value !== null;
        }));
        return $distributor;
    }

    public function changeStatus(int $id, StatusEntity $entity): void
    {
        $distributor = DistributorModel::whereId($id)->firstOrFail();
        $distributor->update($entity->toArray());
    }
    public function getListForDeliveryMan(DistributorFilter $filter, ?int $distributorId)
    {
        return DistributorModel::when($filter->search, function ($q) use ($filter) {
            return $q
                ->where('name_en', 'like', '%' . $filter->search . '%')
                ->orWhere('name_ar', 'like', '%' . $filter->search . '%')
                ->orWhere('id', 'like', '%' . $filter->search . '%')
                ->orWhere('phone_number', 'like', '%' . $filter->search . '%');
        })
            ->when($filter->name_ar, function ($q) use ($filter) {
                return $q->where('name_ar', 'like', '%' . $filter->name_ar . '%');
            })
            ->when($filter->name_en, function ($q) use ($filter) {
                return $q->where('name_en', 'like', '%' . $filter->name_en . '%');
            })
            ->when(isset($filter->type), function ($q) use ($filter) {
                return $q->whereHas('subscriptions', function ($query) use ($filter) {
                    return $query->where('type', $filter->type);
                });
            })
            ->where('status', 1)
            ->whereHas('subscriptions', function ($q) use ($filter) {
                return $q->where('status', 1)
                    ->where('end_date', '>', \Illuminate\Support\Carbon::now());
            })
            ->when($distributorId, function ($q) use ($distributorId) {
                return $q->where('id', $distributorId);
            })
            ->when(isset($filter->order), function ($q) use ($filter) {
                return $q->orderBy('created_at', $filter->order);
            })
            ->paginate($filter->all == true ? 9999999 : $filter->per_page);
    }
}
