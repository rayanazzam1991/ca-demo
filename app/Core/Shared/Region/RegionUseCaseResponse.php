<?php

namespace App\Core\Shared\Region;

use App\Core\Feed\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\PaginationResource;
use Illuminate\Pagination\LengthAwarePaginator;

class RegionUseCaseResponse implements RegionUseCaseOutputInterface
{
    public function index($regions): array
    {
        return ['data' => \App\Http\Resources\V1\SharedSystem\RegionResource::collection($regions),'paginate'=>($regions instanceof LengthAwarePaginator)?PaginationResource::make($regions):null];
    }

    public function show($region):JsonResourceViewModel
    {
        return new JsonResourceViewModel(\App\Http\Resources\V1\SharedSystem\RegionResource::make($region));
    }
}
