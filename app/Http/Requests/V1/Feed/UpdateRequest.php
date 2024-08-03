<?php

namespace App\Http\Requests\V1\Feed;

use Illuminate\Foundation\Http\FormRequest;

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
            'title_ar' => ['required','string'],
            'title_en' => ['required','string'],
            'description' => ['required','string'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,svg,webp','max:10000'],
        ];
    }
}

