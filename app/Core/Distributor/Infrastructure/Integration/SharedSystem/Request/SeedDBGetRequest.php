<?php

namespace App\Core\Distributor\Infrastructure\Integration\SharedSystem\Request;

use App\Http\Resources\V1\DeliverGroup\DeliverGroupResource;
use App\Http\Resources\V1\DeliverMan\DeliverManResource;
use App\Http\Resources\V1\PaymentType\PaymentTypeResource;
use App\Http\Resources\V1\SharedSystem\CityResource;
use App\Http\Resources\V1\SharedSystem\RegionResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SeedDBGetRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly string $domainName, private $paymentTypes, private $deliveryGroups, private $deliveryMen, private $cities, private $regions, private $sub_region, private $manufacturers, private readonly string $username, private readonly string $password, private readonly string $alameenKey)
    {
    }

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
            ? $this->domainName . ':8001/landlord/seed_db'
            : $this->domainName . '/landlord/seed_db');
    }

    protected function defaultBody(): array
    {
        return [
            'payment_methods' => PaymentTypeResource::collection($this->paymentTypes),
            'delivery_man_groups' => DeliverGroupResource::collection($this->deliveryGroups),
            'delivery_men' => $this->prepDeliveryMen(),
            'cities' => CityResource::collection($this->cities),
            'regions' => RegionResource::collection($this->regions),
            'sub_regions' => RegionResource::collection($this->sub_region),
            'manufacturers' =>  $this->prepManufacturers(),
            'username' => $this->username,
            'password' => $this->password,
            'alameen_key' => $this->alameenKey
        ];
    }
    private function prepDeliveryMen(): array
    {
        $deliveryMen = array();
        foreach ($this->deliveryMen as $deliveryMan) {
            $deliveryMen[] = [
                'name_ar' => $deliveryMan->name_ar,
                'name_en' => $deliveryMan->name_en,
                'vehicle_type' => $deliveryMan->vehicle_type,
                'mobile_number' => $deliveryMan->phone_number,
                'status' => $deliveryMan->status,
                'delivery_man_groups_code' => $this->prepDelieveryMenGroupsCodes($deliveryMan)
            ];
        }
        return $deliveryMen;
    }
    private function prepManufacturers(): array
    {
        $manufacturers = array();
        foreach ($this->manufacturers as $manufacturer) {
            $manufacturers[] = [
                'name_ar' => $manufacturer->name_ar,
                'name_en' => $manufacturer->name_en,
                'code' => $manufacturer->code,
                'mobile_number' => $manufacturer->mobile_number,
                'email' => $manufacturer->email,
                'status' => $manufacturer->status,
                'address' => [
                    'sub_region_code' => $manufacturer->address?->region?->code,
                    'street' => $manufacturer->address?->street,
                    'building_number' => $manufacturer->address?->building_number,
                    'lat' => $manufacturer->address?->lat,
                    'lng' => $manufacturer->address?->lng,
                ]
            ];
        }
        return $manufacturers;
    }
    private function prepDelieveryMenGroupsCodes($deliveryMan)
    {
        $codes = array();
        foreach ($deliveryMan->groups as $deliveryManGroup) {
            $codes[] = $deliveryManGroup->code;
        }
        return $codes;
    }
}
