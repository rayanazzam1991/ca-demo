<?php

namespace App\Http\Requests\V1\Subscription;

use App\Core\DistributorSubscription\Domain\Enums\SubscriptionEnum;
use App\Rules\UniqueTenantDomainRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateSubscriptionRequest extends FormRequest
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
            'type' => ['required',Rule::in(SubscriptionEnum::asArray())],
            'paid_amount' => ['required','integer','min:0'],
            'start_date' => ['required','date','date_format:Y-m-d'],
        ];
    }
}
