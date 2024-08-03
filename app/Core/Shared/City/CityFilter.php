<?php

namespace App\Core\Shared\City;

use App\Concerns\BaseFilter;

class CityFilter extends BaseFilter
{
    public function __construct(
        ?int $per_page,
        ?int $page,
        ?string $search,
        ?int   $status,
        public readonly ?string   $name,
        public readonly ?string  $order,
    ){parent::__construct($per_page,$page,$search,$status);}

    public static function fromRequest(array $request): CityFilter
    {
        return new CityFilter(
            per_page: $request["per_page"] ?? 100,
            page: $request["page"] ?? 1,
            search: $request["search"] ?? null,
            status: $request['status']??null,
            name: $request['name']??null,
            order: $request['order']??'DESC',
        );
    }
}
