<?php

namespace  App\Http\Requests\V1\Region;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => ['required','string','unique:regions'],
            'name_en' => ['required','string','unique:regions'],
            'city_id' => [Rule::requiredIf(!$this->parent_region_id), 'exists:cities,id,status,1'],
            'parent_region_id' => [Rule::requiredIf(!$this->city_id), 'exists:regions,id,parent_region_id,NULL,status,1']
        ];
    }

}
