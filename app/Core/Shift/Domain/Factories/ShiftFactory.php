<?php

namespace App\Core\Shift\Domain\Factories;
use App\Core\Shift\Domain\Entities\ShiftEntity;

class ShiftFactory
{
    public static function new(array $attributes = null): ShiftEntity
    {
        return new ShiftEntity(
            pharmacy_id: auth()->user()->pharmacy->id,
            day_of_week:$attributes['day_of_week'],
            start_time: $attributes['start_time'],
            end_time:  $attributes['end_time']
        );
    }
}
