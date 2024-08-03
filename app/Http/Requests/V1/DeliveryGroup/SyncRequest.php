<?php

namespace App\Http\Requests\V1\DeliveryGroup;

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
        $delivery_group = DeliveryManModel::whereCode($this->code??0)->first();
        return [
            'distributor_id' => ['required','integer','exists:distributors,id'],
            'name_ar' => ['required','string',Rule::when(isset($delivery_group),['unique:delivery_groups,name_ar,'.$delivery_group?->id]),Rule::when(!isset($delivery_group),['unique:delivery_groups,name_ar'])],
            'name_en' => ['nullable','string',Rule::when(isset($delivery_group),['unique:delivery_groups,name_en,'.$delivery_group?->id]),Rule::when(!isset($delivery_group),['unique:delivery_groups,name_en'])],
            'code' => ['required','string','unique:delivery_groups']
        ];
    }
}

