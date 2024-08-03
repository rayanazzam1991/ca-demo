<?php

namespace App\Core\Item\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Item\Application\Filter\ItemFilter;
use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class SearchListRequest extends Request
{

    protected Method $method = Method::GET;

    public function __construct(private readonly ItemFilter $filter){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ?config('shared_system_config.base_local_domain'). ':8001/landlord/item/getItemsForAll'
        :config('shared_system_config.base_local_domain'). '/landlord/item/getItemsForAll');
    }


    protected function defaultQuery(): array
    {
        return [
            'per_page' => $this->filter->per_page,
            'page' => $this->filter->page,
            'quick_search' => $this->filter->search,
            'barcode' => $this->filter->barcode
        ];
    }

}
