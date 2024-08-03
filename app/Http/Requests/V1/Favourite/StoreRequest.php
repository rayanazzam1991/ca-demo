<?php

namespace App\Http\Requests\V1\Favourite;

use App\Rules\UniqueItemFavouriteRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'distributor_id' => ['required','integer','exists:distributors,id'],
            'item_id' => ['required','integer','min:1'],
        ];
    }
}
