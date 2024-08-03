<?php

namespace App\Http\Requests\V1\Task;


use App\Core\DistributorSubscription\Domain\Enums\SubscriptionEnum;
use App\Core\Task\Domain\Enums\DeliveryTaskStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeStatusRequest extends FormRequest
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
            'status' => ['required','integer',Rule::in(DeliveryTaskStatus::asArray())],
            'reason' => [Rule::when(($this->staus == DeliveryTaskStatus::FAILED->value),['required']),'string']
        ];
    }
}
