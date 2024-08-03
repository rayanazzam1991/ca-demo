<?php

namespace App\Concerns;

use ReflectionClass;

trait BaseFilterTrait
{
    /**
     * @throws \ReflectionException
     */
    public function toArray(): array{
        $reflection = new ReflectionClass($this);
        $constructor = $reflection->getConstructor();
        $params = $constructor->getParameters();
        $data = [];

        foreach ($params as $param) {
            $property = $param->getName();
            $value = $reflection->getProperty($property)->getValue($this);
            $data[$property] = $value;
        }

        return $data;
    }

    /**
     * @throws \ReflectionException
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
