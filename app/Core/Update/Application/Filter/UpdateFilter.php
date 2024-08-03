<?php

namespace App\Core\Update\Application\Filter;

use App\Concerns\BaseFilterTrait;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Date;

class UpdateFilter extends \App\Concerns\BaseFilter
{
    use BaseFilterTrait;

    public function __construct(
        ?int $per_page,
        ?int $page,
        ?string $search,
        ?int $status,
        public readonly ?DateTime $date_from,
        public readonly ?DateTime $date_to,
    ){parent::__construct($per_page,$page,$search,$status);}

    public static function fromRequest(array $request): UpdateFilter
    {
        return new UpdateFilter(
            per_page: $request["per_page"] ?? 100,
            page:$request["page"] ?? 1,
            search:$request["search"] ?? null,
            status: $attributes['status']??null,
            date_from:isset($request["date_from"])?Carbon::make($request["date_from"]) : Carbon::now()->subWeek()->toDate(),
            date_to:isset($request["date_to"])?Carbon::make($request["date_to"]) : Carbon::now()->toDate()
        );
    }

}
