<?php

namespace App\Http\Requests\V1\Notification;

use App\Enums\NotificationStatusEnum;
use App\Enums\NotificationTypeEnum;
use App\Http\Requests\BaseRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'title_ar' => ['required','string'],
            'title_en' => ['required','string'],
            'description_ar' => ['required','string'],
            'description_en' => ['required','string'],
            'type' => ['required','integer',Rule::in(NotificationTypeEnum::asArray())],
            'status' => ['required','integer',Rule::in(NotificationStatusEnum::asArray())],
            'schedule_time' => ['nullable','date','after_or_equal:'.Carbon::now()->toDateTimeString()],
            'user_ids' => [Rule::when(($this->type == 3 && empty($this->delivery_man_ids)),['required','min:0']),'array'],
            'user_ids.*' => ['nullable','integer','exists:users,id'],
            'delivery_man_ids' => [Rule::when(($this->type == 3 && empty($this->user_ids)),['required','min:0']),'array'],
            'delivery_man_ids.*' => ['required','integer','exists:delivery_men,id'],
        ];
    }
}
