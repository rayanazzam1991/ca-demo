<?php

namespace App\Http\Requests\V1\Pharmacy;

use App\Http\Requests\BaseRequest;

class IndexRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'distributor_id' => ['required', 'exists:distributors,id'],
        ]);
    }
    public function withValidator($validator)
    {
        $validator->sometimes('distributor_id', 'in:' . auth()->guard('delivery')->user()->distributor_id, function ($input) {
            return auth()->guard('delivery')->user()->distributor_id !== null;
        });
    }

}

