<?php

namespace App\Core\Pharmacy\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use App\Core\Shared\Region\RegionModel;
use Illuminate\Support\Facades\App;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SyncClientRequest extends Request implements HasBody
{

    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly PharmacyEntity $entity)
    {
    }

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
            ? config('shared_system_config.base_local_domain') . ':8001/landlord/client'
            : config('shared_system_config.base_local_domain') . '/landlord/client');
    }

    protected function defaultBody(): array
    {
        return [
            "client_name_ar" => $this->entity->name_ar,
            "client_name_en" => $this->entity->name_ar,
            "contact_person_name_ar" => $this->entity->user->full_name_ar,
            "license_number" => $this->entity->license_number,
            "mobile_number" => $this->entity->user->phone_number ?? ((auth()->check()) ? auth()->user()?->phone_number : null),
            "phone_number" => $this->entity->phone_number,
            "date_of_birth" => $this->entity->user->date_of_birth,
            "gender" => $this->entity->user->gender,
            "address" => [
                "sub_region_code" => RegionModel::whereId($this->entity->address->sub_region_id)->first()?->code,
                "street" => $this->entity->address->street,
                "building_number" => $this->entity->address->building_number,
                "lat" => $this->entity->address->lat,
                "lng" => $this->entity->address->lng,
            ]
        ];
    }
}
