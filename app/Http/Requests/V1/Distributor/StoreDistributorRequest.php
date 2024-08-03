<?php

namespace App\Http\Requests\V1\Distributor;

use App\Enums\GenderEnum;
use App\Rules\ValidSubRegionRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDistributorRequest extends FormRequest
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
            'name_ar' => ['required','string','unique:Distributors'],
            'name_en' => ['required','string'],
            'phone_number' => ['required','string','min:10','max:10','starts_with:09','unique:Distributors,phone_number'],
            'email' => ['nullable','string','unique:Distributors,email'],
//            'img' => ['nullable','file','max:10000'],
            'address.street' => ['sometimes','string'],
            'address.building_number' => ['sometimes','string'],
            'address.lat' => ['required','numeric'],
            'address.lng' => ['required','numeric'],
            'address.sub_region_id' => ['required','integer',new ValidSubRegionRule()],
        ];
    }
}
