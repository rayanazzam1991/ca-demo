<?php

namespace  App\Http\Requests\V1\City;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => ['required','string','unique:cities'],
            'name_en' => ['required','string','unique:cities'],
        ];
    }

}
