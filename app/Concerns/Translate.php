<?php

namespace App\Concerns;

trait Translate
{
    public function __get($key)
    {
        if(in_array($key,$this->getTranslateableAttributes()))
        {
            $locale = app()->getLocale();
            $attribute = $key.'_'.$locale;
            return $this->$attribute;
        }
        return parent::__get($key);
    }

    public function getTranslateableAttributes():array
    {
        return is_array($this->translatable)?$this->translatable:[];
    }
}
