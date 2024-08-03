<?php

namespace App\Core\Pharmacy\Infrastructure\Eloquent;

use App\Core\Pharmacy\Application\Repositories\PharmacyRepositoryInterface;
use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;

class PharmacyRepository implements PharmacyRepositoryInterface
{
    public function store(PharmacyEntity $pharmacy,int $address_id,int $user_id):PharmacyModel
    {
        return PharmacyModel::create(array_merge($pharmacy->toArray(),['created_by'=>$user_id,'address_id' => $address_id]));
    }

    public function show(int $id)
    {
        return PharmacyModel::with([])->whereId($id)->first();
    }

    public function update(int $user_id,PharmacyEntity $pharmacy):bool
    {
        return PharmacyModel::where('created_by',$user_id)->update(array_filter($pharmacy->pharmacyEntityToArray(), function ($value) {return $value !== null;}));
    }
}
