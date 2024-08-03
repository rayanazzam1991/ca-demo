<?php

namespace App\Core\Item\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Item\Application\Filter\ItemFilter;
use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetItemListRequest extends Request
{

    protected Method $method = Method::GET;

    public function __construct(private readonly ItemFilter $filter,private readonly string $domain){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
            ? $this->domain . ':8001/landlord/item'
            : $this->domain . '/landlord/item');
    }


    protected function defaultQuery(): array
    {
        return [
            'per_page' => $this->filter->per_page,
            'page' => $this->filter->page,
            'root_category_id' => $this->filter->root_category_id,
            'manufacturers_code' => $this->filter->manufacturers_code,
            'items_id' => $this->filter->items_id,
            'name' => $this->filter->search
        ];
    }

}
