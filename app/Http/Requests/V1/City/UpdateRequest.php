<?php

namespace  App\Http\Requests\V1\City;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => ['nullable','string','unique:cities,name_ar,'.$this->id],
            'name_en' => ['nullable','string','unique:cities,name_en,'.$this->id],
        ];
    }

}
