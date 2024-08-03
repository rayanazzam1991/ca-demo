<?php

namespace App\Http\Requests\V1\Shift;

use App\Core\Shift\Domain\Enums\DaysOfWeekEnum;
use App\Rules\CheckClientShiftsRule;
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
           'shifts.*.day_of_week' => ['required' , Rule::in(DaysOfWeekEnum::asArray())],
           'shifts.*.start_time' => ['required', 'date_format:H:i'],
           'shifts.*.end_time' => ['required', 'date_format:H:i'],
           'shifts' => ['sometimes','array' , new CheckClientShiftsRule($this->shifts) ],
       ];
    }
}
