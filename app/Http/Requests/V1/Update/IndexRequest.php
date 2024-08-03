<?php

namespace App\Http\Requests\V1\Update;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends BaseRequest
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
        return array_merge(Parent::rules(),[
            'date_from' => ['required_with:date_end', 'date','date_format:Y-m-d'],
            'date_to' => ['required_with:date_from', 'date','date_format:Y-m-d','after:date_from'],
        ]);
    }
}
