<?php

namespace App\Core\Shared\City;

use App\Core\Feed\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\PaginationResource;
use Illuminate\Pagination\LengthAwarePaginator;

class CityUseCaseResponse implements CityUseCaseOutputInterface
{
    public function index($cities): array
    {
        return ['data' => \App\Http\Resources\V1\SharedSystem\CityResource::collection($cities),'paginate'=>($cities instanceof LengthAwarePaginator)?PaginationResource::make($cities):null];
    }
    public function show($city):JsonResourceViewModel
    {
        return new JsonResourceViewModel(\App\Http\Resources\V1\SharedSystem\CityResource::make($city));
    }
}
