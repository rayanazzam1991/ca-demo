<?php

namespace App\Core\Order\Domain\Factories;

use App\Core\CartItem\Domain\Factories\CartItemFactory;
use App\Core\Order\Domain\Entities\OrderEntity;

class OrderFactory
{
    public static function new(array $attributes = null,int $distributor_id,$payment_method_code): OrderEntity
    {

        $attributes = $attributes ?: [];

        $defaults = [
            'client_id' =>0,
            'phone_number'=>"",
            'client_group_id'=>1,
            'warehouse_id'=>1,
            'payment_method_id'=>1,
            'discount' =>0,
            'note' => "/",
            'items'=>[]
        ];
        $attributes = array_replace($defaults, $attributes);

        return new OrderEntity(
            client_id :auth()->id(),
            phone_number: auth()->user()->phone_number,
            client_group_id:$attributes['client_group_id'],
            warehouse_id:$attributes['warehouse_id'],
            payment_method_code:$payment_method_code,
            discount :$attributes['discount']??0,
            note : $attributes['note']??"",
            items:static::makeItemEntity($attributes['items'],$distributor_id)
        );
    }

    private static function makeItemEntity(array $items,$distributor_id)
    {
        $result=[];
        foreach ($items as $item)
            $result[]=CartItemFactory::new(array_merge($item,['distributor_id'=>$distributor_id]));
        return $result;
    }


}
