<?php

namespace App\Core\Shared\Region;

use App\Concerns\BaseFilter;

class RegionFilter extends BaseFilter
{
    public function __construct(
        ?int $per_page,
        ?int $page,
        ?string $search,
        ?int   $status,
        public readonly ?string   $name,
        public readonly ?string  $order,
        public readonly ?int  $parent_region_id,
        public readonly ?int  $sub_region_id,
        public readonly ?int  $city_id,
        public readonly ?bool $is_parent,
        public readonly ?bool $is_not_parent,
    ){parent::__construct($per_page,$page,$search,$status);}

    public static function fromRequest(array $request): RegionFilter
    {
        return new RegionFilter(
            per_page: $request["per_page"] ?? 100,
            page: $request["page"] ?? 1,
            search: $request["search"] ?? null,
            status: $request['status']??null,
            name: $request['name']??null,
            order: $request['order']??'DESC',
            parent_region_id: $request['parent_region_id']??null,
            sub_region_id: $request['sub_region_id']??null,
            city_id: $request['city_id']??null,
            is_parent: $request['is_parent']??null,
            is_not_parent: $request['is_not_parent']??null,
        );
    }
}
