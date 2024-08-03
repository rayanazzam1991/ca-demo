<?php

namespace App\Http\Requests\V1\Item;

use App\Http\Requests\BaseRequest;
use Carbon\Carbon;

class PriceVariationRequest extends BaseRequest
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
            'date_from' => ['required','date','date_format:Y-m-d'],
            'date_to' => ['required','date','date_format:Y-m-d','after_or_equal:date_from','before:' . Carbon::now()->addDay()],
        ];
    }
}
