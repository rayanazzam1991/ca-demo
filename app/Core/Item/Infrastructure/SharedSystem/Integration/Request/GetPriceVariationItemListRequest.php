<?php

namespace App\Core\Item\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Item\Application\Filter\ItemFilter;
use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetPriceVariationItemListRequest extends Request
{

    protected Method $method = Method::GET;

    public function __construct(private readonly ItemFilter $filter){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ? config('shared_system_config.base_local_domain').':8001/landlord/itemPriceHistory'
        : config('shared_system_config.base_local_domain').'/landlord/itemPriceHistory');
    }


    protected function defaultQuery(): array
    {
        return [
            'date_from' => $this->filter->date_from,
            'date_to' => $this->filter->date_to,
        ];
    }

}
