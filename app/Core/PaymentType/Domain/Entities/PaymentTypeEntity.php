<?php
namespace App\Core\PaymentType\Domain\Entities;

use App\Concerns\AggregateRoot;

class PaymentTypeEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?string  $name_en,
        public readonly ?string  $name_ar,
        public readonly ?string  $code,
        public readonly ?int  $status,
        public readonly ?int  $created_by,
    ){}
}
