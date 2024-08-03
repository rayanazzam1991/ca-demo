<?php

namespace App\Http\Requests\V1\User;

use App\Enums\GenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProfileRequest extends FormRequest
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
            'name_ar' => ['required','string','unique:pharmacies,name_ar,'.auth()->user()->pharmacy->id],
            'name_en' => ['sometimes','string','unique:pharmacies,name_en,'.auth()->user()->pharmacy->id],
            'license_number'=>['required','string','unique:pharmacies,license_number,'.auth()->user()->pharmacy->id],
            'phone_number'=>['required','string','regex:/^0\d{9}$/','unique:pharmacies,phone_number,'.auth()->user()->pharmacy->id],
            'user.full_name_ar' =>   ['required','string'],
            'user.date_of_birth' =>   ['sometimes','date','date_format:Y-m-d'],
            'user.gender' => ['required','integer',Rule::in(GenderEnum::asArray())],
            'address.street' => ['nullable','string'],
            'address.building_number' => ['nullable','string'],
            'address.lat' => ['required','numeric'],
            'address.lng' => ['required','numeric'],
            'address.sub_region_id' => ['required','integer','exists:regions,id'],
        ];
    }
}
