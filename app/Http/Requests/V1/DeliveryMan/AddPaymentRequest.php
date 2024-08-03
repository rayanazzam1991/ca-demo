<?php

namespace App\Http\Requests\V1\DeliveryMan;

use Illuminate\Foundation\Http\FormRequest;

class AddPaymentRequest extends FormRequest
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
            'distributor_id' => ['required', 'integer'],
            'pharmacy_mobile_number' => ['required', 'string'],
            'amount' => ['required', 'integer', 'min:0'],
            'note' => ['nullable', 'string'],
        ];
    }
}
