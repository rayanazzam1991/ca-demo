<?php

namespace App\Core\Task\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use App\Core\Task\Application\Filter\TaskFilter;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetTaskListRequest extends Request
{


    protected Method $method = Method::GET;

    public function __construct(private readonly TaskFilter $filter, private readonly string $phone_number, private readonly ?int $distributorId)
    {
    }

    public function resolveEndpoint(): string
    {
        if (!$this->distributorId) {
            $url = (env('APP_ENV')  === 'local'
                ? config('shared_system_config.base_local_domain') . ':8001/landlord/deliveryTask/getDeliveryTasksForAll'
                : config('shared_system_config.base_local_domain') . '/landlord/deliveryTask/getDeliveryTasksForAll');
        } else {
            $domain = DistributorModel::whereId($this->distributorId)->first()?->tenant?->local_domain;
            $url = (env('APP_ENV')  === 'local'
                ? $domain . ':8001/landlord/deliveryTask/getDeliveryTasks'
                : $domain . '/landlord/deliveryTask/getDeliveryTasks');
        }
        return 'http://' . $url;
    }

    protected function defaultQuery(): array
    {
        $tenant_id = DistributorModel::whereId($this->filter->distributor_id)->first()?->tenant_id;
        return array_merge(
            $this->filter->toArray(),
            [
                'mobile_number' => $this->phone_number,
                'tenant_id' => $tenant_id,
                'quick_search' => $this->filter->search
            ]
        );
    }
}
