<?php

namespace  App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'per_page' => ['required_with:page', 'integer'],
            'page' => ['required_with:number', 'integer', 'min:1'],
            'search' => ['nullable', 'string'],
            'status' => ['nullable','bool'],
        ];
    }

}
