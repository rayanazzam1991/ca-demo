<?php

namespace App\Core\Shared\Pagination;

use App\Concerns\BaseMapper;
use Illuminate\Database\Eloquent\Model;

class PaginationMapper
{
    use BaseMapper;

    public static function fromEloquent($model): PaginationValueObject
    {

        return new PaginationValueObject(
            total: $model->total(),
            count: $model->count(),
            per_page: $model->perPage(),
            page: $model->currentPage(),
            max_page: $model->lastPage()
        );
    }

}
