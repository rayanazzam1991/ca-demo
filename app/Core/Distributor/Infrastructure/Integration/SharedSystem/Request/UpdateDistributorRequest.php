<?php

namespace App\Core\Distributor\Infrastructure\Integration\SharedSystem\Request;

use App\Core\Distributor\Domain\Entities\DistributorEntity;
use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use App\Core\Shared\Region\RegionModel;
use App\Models\Media;
use Illuminate\Support\Facades\App;
use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Body\HasMultipartBody;

class UpdateDistributorRequest extends Request implements HasBody
{
    use HasMultipartBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly DistributorEntity $distributor, private readonly string $domainName)
    {
    }

    public function resolveEndpoint(): string
    {
        return 'http://' . (env('APP_ENV')  === 'local'
            ? $this->domainName . ':8001/landlord/distributorInfo'
            : $this->domainName . '/landlord/distributorInfo');
    }

    protected function defaultBody()
    {
        $media = Media::where('image_type', DistributorModel::class)->where('image_id', $this->distributor->id)->first();
        if (isset($media))
            $data['image'] = new MultipartValue(name: 'image', value: fopen(public_path('storage/distributor/' . $media->file_name), 'r'));
        if (isset($this->distributor->email))
            $data['email'] = new MultipartValue(name: 'email', value: $this->distributor->email);
        $data['id'] = new MultipartValue(name: 'id', value: $this->distributor->id);
        $data['name_ar'] = new MultipartValue(name: 'name_ar', value: $this->distributor->name_ar);
        $data['name_en'] = new MultipartValue(name: 'name_en', value: $this->distributor->name_en);
        $data['mobile_number'] = new MultipartValue(name: 'mobile_number', value: $this->distributor->phone_number);
        $data['address[sub_region_code]'] = new MultipartValue(name: 'address[sub_region_code]', value: RegionModel::whereId($this->distributor->address->sub_region_id)->first()?->code);
        if (isset($this->distributor->address->street))
            $data['address[street]'] = new MultipartValue(name: 'address[street]', value: $this->distributor->address->street);
        if (isset($this->distributor->address->building_number))
            $data['address[building_number]'] = new MultipartValue(name: 'address[building_number]', value: $this->distributor->address->building_number);
        if (isset($this->distributor->address->lat))
            $data['address[lat]'] = new MultipartValue(name: 'address[lat]', value: (string) $this->distributor->address->lat);
        if (isset($this->distributor->address->lng))
            $data['address[lng]'] = new MultipartValue(name: 'address[lng]', value: (string)  $this->distributor->address->lng);
        return $data;
    }
}
