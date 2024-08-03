<?php

namespace App\Core\Order\Infrastructure\SharedSystem\Integration\Request;

use App\Core\Order\Domain\Entities\OrderEntity;
use App\Core\Pharmacy\Domain\Entities\PharmacyEntity;
use App\Core\Shared\Region\RegionModel;
use App\Core\Shift\Infrastructure\Eloquent\ShiftModel;
use App\Http\Resources\V1\SharedSystem\ShiftResource;
use Illuminate\Support\Facades\App;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateOrderRequest extends Request implements HasBody
{

    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly string $domain, private readonly OrderEntity $entity, private readonly PharmacyEntity $pharmacyEntity)
    {
    }

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
            ? $this->domain . ':8001/landlord/order'
            : $this->domain . '/landlord/order');
    }

    protected function defaultBody(): array
    {
        return [
            'client_number' => $this->entity->phone_number,
            'client_group_id' => $this->entity->client_group_id,
            'warehouse_id' => $this->entity->warehouse_id,
            'payment_method_code' => $this->entity->payment_method_code,
            'discount' => $this->entity->discount,
            'note' => $this->entity->note,
            'items' => $this->preparData(),
            "client" => $this->preparePharmacyData()
        ];
    }

    public function preparData(): array
    {
        $result = [];
        foreach ($this->entity->items as $item) {
            $result[] = [
                'item_unit_id' => $item->unit_item_id,
                'quantity' => $item->qty,
            ];
        }
        return $result;
    }

    public function preparePharmacyData(): array
    {
        return [
            "client_name_ar" => $this->pharmacyEntity->name_ar,
            "client_name_en" => $this->pharmacyEntity->name_ar,
            "contact_person_name_ar" => $this->pharmacyEntity->user->full_name_ar,
            "license_number" => $this->pharmacyEntity->license_number,
            "mobile_number" => $this->pharmacyEntity->user->phone_number ?? ((auth()->check()) ? auth()->user()?->phone_number : null),
            "phone_number" => $this->pharmacyEntity->phone_number,
            "date_of_birth" => $this->pharmacyEntity->user->date_of_birth,
            "status" => 1,
            "gender" => $this->pharmacyEntity->user->gender,
            "address" => [
                "sub_region_code" => RegionModel::whereId($this->pharmacyEntity->address->sub_region_id)->first()?->code,
                "street" => $this->pharmacyEntity->address->street,
                "building_number" => $this->pharmacyEntity->address->building_number,
                'lat' => $this->pharmacyEntity->address->lat,
                'lng' => $this->pharmacyEntity->address->lng,
            ],
            "shifts" => ShiftResource::collection(ShiftModel::where('pharmacy_id', $this->pharmacyEntity->id)->get())
        ];
    }
}
