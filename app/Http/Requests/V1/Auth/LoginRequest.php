<?php

namespace App\Http\Requests\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'phone_number' => ['required', 'string', 'exists:users'],
            'code' => ['required', 'string', 'min:4', 'max:4'],
        ];
        if ($globalEnv === 'false') {
            $rules['phone_number'][] =  'min:10';
            $rules['phone_number'][] =  'max:10';
            $rules['phone_number'][] =  'starts_with:09';
        }
        return $rules;
    }
}
