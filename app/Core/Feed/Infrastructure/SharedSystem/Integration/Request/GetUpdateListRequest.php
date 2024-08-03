<?php

namespace App\Core\Feed\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Feed\Application\Filter\FeedFilter;
use App\Enums\UpdateTypeEnum;
use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetUpdateListRequest extends Request
{

    protected Method $method = Method::GET;

    public function __construct(private readonly FeedFilter $filter){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ?config('shared_system_config.base_local_domain'). ':8001/landlord/itemUpdate/getItemUpdatesForAll'
        :config('shared_system_config.base_local_domain'). '/landlord/itemUpdate/getItemUpdatesForAll');
    }


    protected function defaultQuery(): array
    {
        return [
            'date_from' => $this->filter->start_date,
            'date_to' => $this->filter->end_date,
            'status' => 1,
            'types' => isset($this->filter->type)?[$this->filter->type]:UpdateTypeEnum::asArray(),
        ];
    }

}
