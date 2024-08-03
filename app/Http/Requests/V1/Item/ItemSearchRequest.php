<?php

namespace App\Http\Requests\V1\Item;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ItemSearchRequest extends BaseRequest
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
            'barcode' => ['nullable','string'],
        ]);
    }
}