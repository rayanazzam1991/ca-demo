<?php

namespace App\Core\Item\Application\Filter;

use App\Concerns\BaseFilter;

class ItemFilter extends BaseFilter
{
    public function __construct(
        ?int                    $per_page,
        ?int                    $page,
        ?string                 $search,
        public readonly ?string $barcode,
        ?int                    $status,
        public readonly ?string $date_from,
        public readonly ?string $date_to,
        public readonly ?int    $type_id,
        public readonly ?int    $distributor_id,
        public readonly ?int    $root_category_id,
        public readonly ?array  $manufacturers_code,
        public readonly ?array  $items_id,
    ) {
        parent::__construct($per_page, $page, $search, $status);
    }

    public static function fromRequest(array $request): ItemFilter
    {
        return new ItemFilter(
            per_page: $request["per_page"] ?? 100,
            page: $request["page"] ?? 1,
            search: $request["search"] ?? null,
            barcode: $request["barcode"] ?? null,
            status: $request['status'] ?? 1, // TODO change it to enum
            date_from: $request['date_from'] ?? null,
            date_to: $request['date_to'] ?? null,
            type_id: $request['type_id'] ?? null,
            distributor_id: $request['distributor_id'] ?? null,
            root_category_id: $request['root_category_id'] ?? null,
            items_id: $request['items_id'] ?? [],
            manufacturers_code: $request['manufacturers_code'] ?? null
        );
    }
}
