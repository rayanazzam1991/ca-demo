<?php

namespace App\Core\ActivityLog\Application\Filter;

use App\Concerns\BaseFilter;

class ActivtyLogFilter extends BaseFilter
{
    public function __construct(
        ?int $per_page,
        ?int $page,
        ?string $search,
        ?int   $status,
        public readonly ?string  $order,
        public readonly ?int   $user_id,
    ){parent::__construct($per_page,$page,$search,$status);}

    public static function fromRequest(array $request): ActivtyLogFilter
    {
        return new ActivtyLogFilter(
            per_page: $request["per_page"] ?? 100,
            page: $request["page"] ?? 1,
            search: $request["search"] ?? null,
            order: $request['order']??'DESC',
            status: $request['status']??null,
            user_id: $request['user_id']??null,
        );
    }
}
