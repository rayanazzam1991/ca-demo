<?php

namespace App\Core\Update\Application\Repositories;

use App\Core\Update\Application\DTO\UpdateWithDataDTO;
use App\Core\Update\Application\DTO\UpdateWithPaginatedDataDTO;
use App\Core\Update\Application\Filter\UpdateFilter;
use App\Core\Update\Domain\Entities\Update;
use App\Core\Update\Infrastructure\Eloquent\UpdateModel;
use Illuminate\Pagination\LengthAwarePaginator;

interface UpdateRepositoryInterface
{
    public function store(Update $update): UpdateWithDataDTO;

    public function getList(UpdateFilter $filter) :LengthAwarePaginator;

    public function getOne(int $id) :UpdateModel;

}
