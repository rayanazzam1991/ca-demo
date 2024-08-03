<?php

namespace App\Contracts;

use App\Core\Banner\BannerModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CrudRepositoryInterface
{
    public function findAll(): LengthAwarePaginator|Collection;

    public function findOrFail(int $id): Model;

    public function create(array $data): BannerModel;

    public function update(int $id, array $data): Model;

    public function destroy(int $id): void;
}
