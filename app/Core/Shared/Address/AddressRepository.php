<?php

namespace App\Core\Shared\Address;


class AddressRepository implements AddressRepositoryInterface
{
     public function store(AddressEntity $addressEntity):AddressModel
     {
         return AddressModel::create($addressEntity->toArray());
     }

    public function update(int $id,AddressEntity $addressEntity):bool
    {
        return AddressModel::whereId($id)->update(array_filter($addressEntity->toArray(), function ($value) {return $value !== null;}));
    }
}
