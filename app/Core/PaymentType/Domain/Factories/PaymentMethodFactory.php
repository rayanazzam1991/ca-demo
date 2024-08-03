<?php
namespace App\Core\PaymentType\Domain\Factories;

use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;

class PaymentMethodFactory
{
    public static function new(array $attributes = null): PaymentTypeEntity
    {
        return new PaymentTypeEntity(
            name_en: $attributes['name_en']??'',
            name_ar: $attributes['name_ar']??'',
            code: $attributes['code']??null,
            status: $attributes['status']??null,
            created_by: auth()->id()??null
        );
    }


}
