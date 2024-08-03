<?php

namespace App\Http\Requests\V1\Feed;

use App\Enums\UpdateTypeEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class GetUpdateListRequest extends BaseRequest
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
            'type' => ['sometimes',Rule::in(UpdateTypeEnum::asArray())]
        ]);
    }
}
