<?php

namespace App\Http\Requests\V1\Auth;

use App\Enums\GenderEnum;
use App\Rules\ValidSubRegionRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignupRequest extends FormRequest
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
        $globalEnv = env('GLOBAL_ENV', true);

        $rules = [
            'name_ar' => ['required', 'string', 'unique:pharmacies'],
            'name_en' => ['sometimes', 'string', 'unique:pharmacies'],
            'license_number' => ['required', 'max:20', 'regex:/^\d+$/', 'unique:pharmacies'],
            'phone_number' => ['required', 'string', 'regex:/^0\d{9}$/', 'unique:pharmacies'],
            'user.full_name_ar' =>   ['required', 'string'],
            'user.phone_number' => ['required', 'string', 'unique:users,phone_number'],
            'user.date_of_birth' =>   ['sometimes', 'date', 'date_format:Y-m-d'],
            'user.gender' => ['required', 'integer', Rule::in(GenderEnum::asArray())],
            'address.street' => ['sometimes', 'string'],
            'address.building_number' => ['sometimes', 'string'],
            'address.lat' => ['required ', 'numeric'],
            'address.lng' => ['required ', 'numeric'],
            'address.sub_region_id' => ['required', 'integer', new ValidSubRegionRule()],
        ];
        if ($globalEnv === 'false') {
            $rules['user.phone_number'][] =  'min:10';
            $rules['user.phone_number'][] =  'max:10';
            $rules['user.phone_number'][] =  'starts_with:09';
        }
        return $rules;
    }
}
