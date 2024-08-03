<?php

namespace App\Http\Requests\V1\Region;

use App\Http\Requests\BaseRequest;
use App\Rules\ValidSubRegionRule;
use Illuminate\Validation\Rule;

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
        return array_merge(Parent::rules(), [
            'city_id' => ['nullable', 'integer', 'exists:cities,id'],
            'parent_region_id' => ['nullable', 'integer', 'exists:regions,id'],
            'sub_region_id' => ['nullable', 'integer', new ValidSubRegionRule()],
            'is_parent' => ['nullable', Rule::in(true, false, 0, 1)],
            'is_not_parent' => ['nullable', Rule::in(true, false, 0, 1)],
            'order'  =>  ['nullable', 'string'],
            'name' => ['nullable', 'string'],
        ]);
    }
}
