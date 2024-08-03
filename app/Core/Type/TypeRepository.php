<?php

namespace App\Core\Type;

use App\Concerns\BaseEloquentRepository;

class TypeRepository
{
    use BaseEloquentRepository;

    public function model():string
    {
        return TypeModel::class;
    }
}
