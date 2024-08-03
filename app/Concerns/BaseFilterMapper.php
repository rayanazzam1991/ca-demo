<?php

namespace App\Concerns;


class BaseFilterMapper
{
  use BaseMapper;

    public static function fromRequest(array $requestData):BaseFilter
    {
        return BaseFilterFactory::new($requestData);
    }
}
