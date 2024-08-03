<?php

namespace App\Core\Distributor\Domain\Factories;

use App\Core\Distributor\Domain\Entities\DistributorEntity;
use App\Core\Shared\Address\AddressFactory;
use App\Core\Tenant\Domain\Factories\TenantFactory;
use Illuminate\Http\UploadedFile;


class DistributorFactory
{
    public static function new(array $attributes = null, $image = null): DistributorEntity
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'id' => null,
            'name_ar' => null,
            'name_en' => null,
            'phone_number' => null,
            'email' => null,
            'address' => AddressFactory::new(),
            'tenant' => TenantFactory::new(),
            'image' => null,
            'remove_image' => false
        ];
        $attributes = array_replace($defaults, $attributes);

        return new DistributorEntity(
            id: $attributes['id'] ?? null,
            name_ar: $attributes['name_ar'],
            name_en: $attributes['name_en'],
            phone_number: $attributes['phone_number'],
            created_by: auth()->user()?->id,
            email: $attributes['email'],
            image: $attributes['image'] ?? $image,
            remove_image: $attributes['remove_image'],
            address: isset($attributes["address"]) ? AddressFactory::new($attributes["address"]) : AddressFactory::new(),
            tenant: TenantFactory::new([
                'name' => $attributes['name_en'],
                'domain' => DistributorFactory::formatDomain($attributes['domain']?? ''),
            ])
        );
    }
    private static function formatDomain(string $domain): string
    {
        $domain = str_replace(['_', ' '], '', $domain);
        $domain = preg_replace("/[^a-zA-Z0-9]/", "", $domain);
        return $domain;
    }
}
