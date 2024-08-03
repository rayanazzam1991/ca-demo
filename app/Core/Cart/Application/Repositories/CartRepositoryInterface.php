<?php

namespace App\Core\Cart\Application\Repositories;

use App\Core\Cart\Domain\Entities\CartEntity;
use App\Core\Cart\Infrastructure\Eloquent\CartModel;

interface CartRepositoryInterface
{
    public function getByUser($user_id):CartModel|null;
    public function store(CartEntity $entity):CartModel;
    public function delete($id):void;
    public function deleteByUser($user_id):void;

}
