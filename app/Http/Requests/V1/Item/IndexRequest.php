<?php

namespace App\Http\Requests\V1\Item;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return array_merge(Parent::rules(),[
            'distributor_id' => ['required','integer','exists:distributors,id'],
            'root_category_id' => ['sometimes','integer'],
            'manufacturers_code' => ['sometimes' , 'array'],
            'manufacturers_code.*' => ['required' , 'string']
        ]);
    }
}
