<?php

namespace App\Http\Requests\V1\Distributor;

use App\Rules\ValidSubRegionRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDistributorRequest extends FormRequest
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
            'name_ar' => ['required','string','unique:distributors,name_ar,'.$this->id],
            'name_en' => ['required','string','unique:distributors,name_en,'.$this->id],
            'phone_number' => ['required','string','min:10','max:10','starts_with:09','unique:distributors,phone_number,'.$this->id],
            'email' => ['nullable','string','unique:distributors,email,'.$this->id],
            'image' => ['nullable', 'mimes:jpg,jpeg,png,svg,webp','max:10000'],
            'remove_image' => ['nullable','boolean'],
            'address.street' => ['nullable','string'],
            'address.building_number' => ['nullable','string'],
            'address.lat' => ['required','numeric'],
            'address.lng' => ['required','numeric'],
            'address.sub_region_id' => ['required','integer',new ValidSubRegionRule()],
        ];
    }
}
