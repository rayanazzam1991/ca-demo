<?php

namespace App\Core\Feed\Application\Filter;

use App\Concerns\BaseFilter;

class FeedFilter extends BaseFilter
{
    public function __construct(
        ?int $per_page,
        ?int $page,
        ?string $search,
        ?int   $status,
        public readonly ?string   $title_en,
        public readonly ?string   $title_ar,
        public readonly ?string  $order,
        public readonly ?string  $start_date,
        public readonly ?string  $end_date,
        public readonly ?int  $type,
    ){parent::__construct($per_page,$page,$search,$status);}

    public static function fromRequest(array $request): FeedFilter
    {
        return new FeedFilter(
            per_page: $request["per_page"] ?? 100,
            page: $request["page"] ?? 1,
            search: $request["search"] ?? null,
            status: $request['status']??null,
            title_en: $request['title_en']??null,
            title_ar: $request['title_ar']??null,
            order: $request['order']??'DESC',
            start_date: $request['start_date']??null,
            end_date: $request['end_date']??null,
            type: $request['type']??null
        );
    }
}
