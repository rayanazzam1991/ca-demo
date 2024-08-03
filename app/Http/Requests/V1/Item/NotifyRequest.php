<?php

namespace App\Http\Requests\V1\Item;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class NotifyRequest extends BaseRequest
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
        return [
            'tenant_id' => ['required','integer','exists:tenants,id'],
            'item_id' => ['required','integer'],
            'name_ar' => ['required','string'],
            'name_en' => ['required','string'],
        ];
    }
}
