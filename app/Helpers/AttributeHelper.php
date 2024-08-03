<?php

namespace App\Helpers;


class AttributeHelper
{

    public function getAttributeValue($model_id, $model_type)
    {
        $model = $model_type::query()->where('id', $model_id)->first();
        if ($model) {
            return $model->name_ar;
        }
        return $model_id;
    }
}
