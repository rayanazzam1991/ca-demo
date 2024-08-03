<?php

namespace App\Http\Requests\V1\DeliveryMan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name_ar' => ['required','string','unique:delivery_men,name_ar,'.$this->id],
            'name_en' => ['nullable','string','unique:delivery_men,name_en,'.$this->id],
            'vehicle_type' => ['nullable','string'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,svg,webp','max:10000'],
            'group_ids' => ['required','array','min:1'],
            'group_ids.*' => ['required','integer','exists:delivery_groups,id'],
        ];
    }
}

