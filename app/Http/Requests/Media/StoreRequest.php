<?php

namespace App\Http\Requests\Media;

use App\Enums\MediaModelsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'model_type' => ['bail','required','string',Rule::in(MediaModelsEnum::asArray())],
            'model_id'=>['required','integer'],
            'file' => ['required','file','max:10000'],
        ];
    }
}
