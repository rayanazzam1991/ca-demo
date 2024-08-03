<?php

namespace App\Core\Shared\Region;

use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;
use App\Core\Shared\City\CityEntity;
use App\Core\Shared\City\CityModel;
use Illuminate\Support\Facades\App;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SyncRegionRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly RegionEntity $entity){}

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
        ? config('shared_system_config.base_local_domain') . ':8001/landlord/region/sync'
        : config('shared_system_config.base_local_domain'). '/landlord/region/sync');
    }

    protected function defaultBody(): array
    {
        return $this->prepareData();
    }

    public function prepareData()
    {
        return [
            'name_ar' => $this->entity->name_ar,
            'name_en' => $this->entity->name_en,
            'status' => $this->entity->status,
            'code' => $this->entity->code,
            'city_code'=> !isset($this->entity->parent_region_id)?CityModel::whereId($this->entity->city_id)->first()?->code:null,
            'parent_region_code'=>RegionModel::whereId($this->entity->parent_region_id)->first()?->code,
        ];
    }
}
