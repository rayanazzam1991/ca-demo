<?php

namespace App\Http\Requests\V1\Manufacturer;

use App\Core\Shared\Region\RegionModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

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
            'name_ar' => 'sometimes|string|max:125|unique:manufacturers,name_ar',
            'name_en' => 'sometimes|max:125|unique:manufacturers,name_en',
            'mobile_number' => ['sometimes', 'string', 'unique:manufacturers,mobile_number'],
            'email' => 'sometimes|email:filter|max:50|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/|unique:manufacturers,email',
            'address' => 'sometimes|array',
            'address.sub_region_id' => [
                'sometimes',
                function ($attribute, $value, $fail) {
                    if (!isset($value)) {
                        $fail(Lang::get('validation.exists'));
                    } else {
                        $subRegion = RegionModel::where('id', $value)
                            ->whereNotNull('parent_region_id')
                            ->where('status', 1)
                            ->first();
                        if (!$subRegion) {
                            $fail(Lang::get('validation.exists'));
                        }
                    }
                }
            ],
            'address.street' => 'sometimes|string|max:125',
            'address.building_number' => 'sometimes|string|max:125',
            'address.lat' => 'sometimes|numeric',
            'address.lng' => 'sometimes|numeric',
            'image' => 'sometimes|image|mimes:jpeg,png,gif,webp|max:2048',
        ];
    }
}
