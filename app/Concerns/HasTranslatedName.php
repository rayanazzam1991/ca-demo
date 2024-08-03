<?php

namespace App\Concerns;


use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasTranslatedName
{
    /**
     * @throws \ReflectionException
     */
    public function name():Attribute
    {
        return Attribute::make(
            get: fn() => $this->{'name_' . app()->getLocale()},
        );
    }
}
