<?php

namespace App\Core\Order\Application\Mappers;

use App\Concerns\BaseMapper;
use App\Core\Order\Domain\Entities\ReturnOrderEntity;
use App\Core\Order\Domain\Factories\ReturnOrderFactory;

class ReturnOrderMapper
{

    use BaseMapper;

    public static function fromRequest(array $requestData):ReturnOrderEntity
    {
        return ReturnOrderFactory::new($requestData);
    }
}
