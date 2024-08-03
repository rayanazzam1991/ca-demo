<?php

namespace App\Core\Distributor\Application\Filter;

use App\Concerns\BaseFilter;

class DistributorFilter extends BaseFilter
{
    public function __construct(
        ?int $per_page,
        ?int $page,
        ?string $search,
        ?int   $status,
        ?bool   $all,
        public readonly ?int   $type,
        public readonly ?string   $name_en,
        public readonly ?string   $name_ar,
        public readonly ?string  $order,
    ){parent::__construct($per_page,$page,$search,$status,$all);}

    public static function fromRequest(array $request): DistributorFilter
    {
        return new DistributorFilter(
            per_page: $request["per_page"] ?? 100,
            page:$request["page"] ?? 1,
            search:$request["search"] ?? null,
            status: $request['status']??null,
            type: $request['type']??null,
            name_en: $request['name_en']??null,
            name_ar: $request['name_ar']??null,
            order: $request['order']??'DESC',
            all: $request['all'] ?? null
        );
    }
}
