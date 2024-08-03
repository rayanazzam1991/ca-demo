<?php

namespace App\Core\Task\Application\Filter;

use App\Concerns\AggregateRoot;
use App\Concerns\BaseFilter;

class TaskFilter extends BaseFilter
{
    use AggregateRoot;
    public function __construct(
        ?int $per_page,
        ?int $page,
        ?string $search,
        ?int   $status,
        public readonly ?int $is_todo,
        public readonly ?int  $type,
        public readonly ?int $distributor_id,
    ){parent::__construct($per_page,$page,$search,$status);}

    public static function fromRequest(array $request): TaskFilter
    {
        return new TaskFilter(
            per_page: $request["per_page"] ?? 100,
            page: $request["page"] ?? 1,
            search: $request["search"] ?? null,
            status: $request['status']??null,
            is_todo:$request['is_todo']??null,
            type:  $request['type']??null,
            distributor_id:$request['distributor_id']??null
        );
    }
}
