<?php

namespace App\Core\Item\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Item\Application\Filter\ItemFilter;
use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetAlternativeItemListRequest extends Request
{

    protected Method $method = Method::GET;

    public function __construct(private readonly ItemFilter $filter, private readonly string $domain, private readonly int $id){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
            ? $this->domain . ':8001/landlord/item/'.$this->id.'/getAlternativeItems'
            : $this->domain . '/landlord/item/'.$this->id.'/getAlternativeItems');
    }


    protected function defaultQuery(): array
    {
        return [
            'per_page' => $this->filter->per_page,
            'page' => $this->filter->page,
        ];
    }

}
