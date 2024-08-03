<?php

namespace App\Core\Order\Infrastructure\SharedSystem\Integration\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class OrderListRequest extends Request
{


    protected Method $method = Method::GET;

    public function __construct(private $orders){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ? config('shared_system_config.base_local_domain') . ':8001/landlord/order/getOrdersByTenants'
        : config('shared_system_config.base_local_domain'). '/landlord/order/getOrdersByTenants');
    }

    protected function defaultQuery(): array
    {
        return [
            'tenants_with_orders' => $this->preparData(),
            'all' => true
        ];
    }

    public function preparData():array
    {
        $result = [];
        foreach ($this->orders as $order)
        {
            $is_exist = false;
            for ($i=0;$i<count($result);$i++)
            {

                if($result[$i]['tenant_id'] == $order->distributor->tenant->id)
                {
                    $is_exist=true;
                    $result[$i]['orders_id'][] = $order->order_id;
                }
            }

            if(!$is_exist)
                $result[] = ['tenant_id' => $order->distributor->tenant->id, 'orders_id' => [$order->order_id]];
        }
        return $result;
    }
}
