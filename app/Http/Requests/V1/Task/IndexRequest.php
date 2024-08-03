<?php

namespace App\Http\Requests\V1\Task;


use App\Core\DistributorSubscription\Domain\Enums\SubscriptionEnum;
use App\Http\Requests\BaseRequest;
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
        return array_merge(Parent::rules(),[
            'is_todo' => ['nullable','boolean'],
            'type' => ['nullable','integer',Rule::in([1,2])],
            'distributor_id' => ['nullable','integer','exists:distributors,id'],
        ]);
    }
}
