<?php
namespace App\Core\PaymentType\Application\Mappers;

use App\Concerns\BaseMapper;
use App\Core\PaymentType\Domain\Entities\PaymentTypeEntity;
use App\Core\PaymentType\Domain\Factories\PaymentMethodFactory;

class PaymentTypeMapper
{
    use BaseMapper;
    public static function fromRequest(array $request): PaymentTypeEntity
    {
        return  PaymentMethodFactory::new($request);
    }

}
