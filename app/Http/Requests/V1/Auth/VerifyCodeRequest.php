<?php

namespace App\Http\Requests\V1\Auth;

use App\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyCodeRequest extends FormRequest
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
            'phone_number' => [
                'required', 'string',
                Rule::when(($this->is_login && $this->type == UserTypeEnum::pharmacy->value), ['exists:users,phone_number']),
                Rule::when((!$this->is_login && $this->type == UserTypeEnum::pharmacy->value), ['unique:users,phone_number']),
                Rule::when(($this->type == UserTypeEnum::delivery->value), ['exists:delivery_men,phone_number']),
            ],
            'code' => ['required', 'string', 'min:4', 'max:4'],
            'is_login' => ['required', 'bool'],
            'type' => ['required', 'integer', Rule::in(UserTypeEnum::asArray())],
        ];
        if ($globalEnv === 'false') {
            $rules['phone_number'][] =  'min:10';
            $rules['phone_number'][] =  'max:10';
            $rules['phone_number'][] =  'starts_with:09';
        }
        return $rules;
    }
}
