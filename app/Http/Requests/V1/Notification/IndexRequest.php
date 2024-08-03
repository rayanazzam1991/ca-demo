<?php

namespace App\Http\Requests\V1\Notification;

use App\Enums\NotificationStatusEnum;
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
            'schedule_date_from' => ['nullable','date'],
            'schedule_date_to' => ['nullable','date'],
            'notification_status' => ['nullable',Rule::in(NotificationStatusEnum::asArray())],
            'user_ids' => ['nullable','array'],
            'user_ids.*' => ['required','integer','exists:users,id'],
            'delivery_man_ids' => ['nullable','array'],
            'delivery_man_ids.*' => ['required','integer','exists:delivery_men,id'],
            'order'  =>  ['nullable','string'],
        ]);
    }
}
