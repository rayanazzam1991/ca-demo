<?php

namespace App\Http\Requests\V1\Distributor;

use App\Rules\UniqueTenantDomainRule;
use App\Rules\ValidSubRegionRule;
use Illuminate\Foundation\Http\FormRequest;

class OnboardDistributorRequest extends FormRequest
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
            'name_ar' => ['required','string','unique:distributors'],
            'name_en' => ['required','string','unique:distributors'],
            'domain' => ['required','string',new UniqueTenantDomainRule()],
            'phone_number' => ['required','string','min:10','max:10','starts_with:09','unique:distributors,phone_number'],
            'email' => ['nullable','string','unique:distributors,email'],
            'address.street' => ['nullable','string'],
            'address.building_number' => ['nullable','string'],
            'address.lat' => ['required','numeric'],
            'address.lng' => ['required','numeric'],
            'address.sub_region_id' => ['required','integer',new ValidSubRegionRule()],
            'username' => ['required' , 'string' ,'max:20']
        ];
    }
}
