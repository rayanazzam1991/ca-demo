<?php
namespace App\Core\Favourite\Domain\Factories;

use App\Core\Favourite\Domain\Entities\FavouriteEntity;

class FavouriteFactory
{
    public static function new(array $attributes = null): FavouriteEntity
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'item_id' => 0,
            'distributor_id' => 0,
            'user_id' => 0
        ];
        $attributes = array_replace($defaults, $attributes);

        return new FavouriteEntity(
            item_id: $attributes['item_id'],
            distributor_id: $attributes['distributor_id'],
            user_id:auth()->id()
        );
    }


}
