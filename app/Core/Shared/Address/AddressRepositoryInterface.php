<?php

namespace App\Core\Shared\Address;

interface AddressRepositoryInterface
{
    public function store(AddressEntity $addressEntity):AddressModel;
    public function update(int $id,AddressEntity $addressEntity):bool;
}
