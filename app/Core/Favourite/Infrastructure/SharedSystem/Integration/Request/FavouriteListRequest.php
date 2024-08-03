<?php

namespace App\Core\Favourite\Infrastructure\SharedSystem\Integration\Request;

use Illuminate\Support\Facades\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class FavouriteListRequest extends Request
{


    protected Method $method = Method::GET;

    public function __construct(private $favourites){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ? config('shared_system_config.base_local_domain') . ':8001/landlord/item/getItemsByTenants'
        : config('shared_system_config.base_local_domain'). '/landlord/item/getItemsByTenants');
    }

    protected function defaultQuery(): array
    {
        return [
            'tenants_with_items' => $this->preparData(),
            'all' => true
        ];
    }

    public function preparData():array
    {
        $result = [];
        foreach ($this->favourites as $favourite)
        {
            $is_exist = false;
            for ($i=0;$i<count($result);$i++)
            {

                if($result[$i]['tenant_id'] == $favourite->distributor->tenant->id)
                {
                    $is_exist=true;
                    $result[$i]['items_id'][] = $favourite->item_id;
                }
            }

            if(!$is_exist)
                $result[] = ['tenant_id' => $favourite->distributor->tenant->id, 'items_id' => [$favourite->item_id]];
        }
        return $result;
    }
}
