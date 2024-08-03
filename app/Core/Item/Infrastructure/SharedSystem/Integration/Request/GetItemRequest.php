<?php

namespace App\Core\Item\Infrastructure\SharedSystem\Integration\Request;

use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetItemRequest extends Request
{

    protected Method $method = Method::GET;

    public function __construct(private string $domain,private string $item_id){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
         ?$this->domain . ':8001/landlord/item/'.$this->item_id
         :$this->domain . '/landlord/item/'.$this->item_id);
    }

}
