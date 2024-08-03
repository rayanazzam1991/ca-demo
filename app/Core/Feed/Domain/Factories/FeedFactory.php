<?php

namespace App\Core\Feed\Domain\Factories;

use App\Core\Distributor\Domain\Entities\DistributorEntity;
use App\Core\Feed\Domain\Entities\FeedEntity;
use App\Core\Shared\Address\AddressFactory;
use App\Core\Tenant\Domain\Factories\TenantFactory;
use Illuminate\Http\UploadedFile;


class FeedFactory
{
    public static function new(array $attributes = null): FeedEntity
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'id' => null,
            'title_en' => null,
            'title_ar' => null,
            'description' => null,
            'created_by'=>null,
            'image' => null,
        ];
        $attributes = array_replace($defaults, $attributes);

        return new FeedEntity(
            id: null,
            title_ar: $attributes['title_ar'],
            title_en: $attributes['title_en'],
            description: $attributes['description'],
            created_by: auth()->user()?->id,
            image: $attributes['image'],
        );
    }
}
