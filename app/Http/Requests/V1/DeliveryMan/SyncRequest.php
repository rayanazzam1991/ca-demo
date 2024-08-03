<?php

namespace App\Http\Requests\V1\DeliveryMan;

use App\Core\DeliveryMan\Infrastructure\Eloquent\DeliveryManModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SyncRequest extends FormRequest
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
        $delivery_man = DeliveryManModel::wherePhoneNumber($this->phone_number??0)->first();
        return [
            'distributor_id' => ['required','integer','exists:distributors,id'],
            'name_ar' => ['required','string',Rule::when(isset($delivery_man),['unique:delivery_men,name_ar,'.$delivery_man?->id]),Rule::when(!isset($delivery_man),['unique:delivery_men,name_ar'])],
            'name_en' => ['nullable','string',Rule::when(isset($delivery_man),['unique:delivery_men,name_en,'.$delivery_man?->id]),Rule::when(!isset($delivery_man),['unique:delivery_men,name_en'])],
            'phone_number'=>['required','string','regex:/^0\d{9}$/',Rule::when(isset($delivery_man),['unique:delivery_men,phone_number,'.$delivery_man?->id]),Rule::when(!isset($delivery_man),['unique:delivery_men,phone_number'])],
            'vehicle_type' => ['nullable','string'],
            'status' => ['nullable','bool'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,svg,webp','max:10000'],
            'group_codes' => ['required','array','min:1'],
            'group_codes.*' => ['required','string','exists:delivery_groups,code'],
        ];
    }
}

