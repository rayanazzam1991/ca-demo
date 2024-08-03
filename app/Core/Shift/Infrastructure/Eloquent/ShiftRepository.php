<?php

namespace App\Core\Shift\Infrastructure\Eloquent;

use App\Core\Shift\Application\Repositories\ShiftRepositoryInterface;
use App\Core\Shift\Domain\Entities\ShiftEntity;

class ShiftRepository implements ShiftRepositoryInterface
{
    public function index()
    {
        return ShiftModel::where('pharmacy_id',auth()->user()->pharmacy->id)->get();
    }

    public function sync($shifts):void
    {
        ShiftModel::where('pharmacy_id',auth()->user()->pharmacy->id)->delete();
        foreach ($shifts as $value)
            if($value instanceof ShiftEntity)
                ShiftModel::query()->create($value->toArray());
    }
}
