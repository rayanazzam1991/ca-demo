<?php

namespace App\Core\Update\Infrastructure\Eloquent;

use App\Core\Update\Application\DTO\UpdateWithDataDTO;
use App\Core\Update\Application\DTO\UpdateWithPaginatedDataDTO;
use App\Core\Update\Application\Filter\UpdateFilter;
use App\Core\Update\Application\Repositories\UpdateRepositoryInterface;
use App\Core\Update\Domain\Entities\Update;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UpdateEloquentRepository implements UpdateRepositoryInterface
{

    public function store(Update $update): UpdateWithDataDTO
    {
        return DB::transaction(function () use ($update) {
            $update = UpdateModel::create($update->toArray());
            return UpdateWithPaginatedDataDTO::fromEloquent($update);
        });
    }

    public function getList(UpdateFilter $filter):LengthAwarePaginator
    {
        $model = UpdateModel::query()
        ->when($filter->date_from,function (Builder $query)use($filter){
            return $query->where('created_at','>=',$filter->date_from)
                        ->where('created_at','<',$filter->date_to);
        });
        return $model->with(['update_type'])->paginate($filter->per_page);
    }

    public function getOne(int $id) :UpdateModel
    {
        return UpdateModel::with('update_type')->whereId($id)->firstOrFail();
    }
}
