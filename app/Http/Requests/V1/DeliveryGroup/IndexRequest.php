<?php

namespace  App\Http\Requests\V1\DeliveryGroup;

use App\Http\Requests\BaseRequest;

class IndexRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(),[
            'name' => ['nullable','string'],
            'order'  =>  ['nullable','string'],
        ]);
    }

}
