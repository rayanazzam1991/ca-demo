<?php

namespace App\Core\Pharmacy\Application\Repositories;

use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use App\Core\Pharmacy\Infrastructure\Eloquent\PharmacyModel;

interface PharmacyRepositoryInterface
{
    public function store(PharmacyEntity $pharmacy,int $address_id,int $user_id):PharmacyModel;
    public function update(int $user_id,PharmacyEntity $pharmacy):bool;
}
