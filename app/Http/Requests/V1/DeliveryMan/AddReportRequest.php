<?php

namespace App\Http\Requests\V1\DeliveryMan;

use App\Core\DeliveryMan\Domain\Enums\DeliveryManReportablesType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddReportRequest extends FormRequest
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
            'title' => ['required','string'],
            'description' => ['required','string'],
            'distributor_id' => ['required','integer','exists:distributors,id'],
            'task_id' => ['required','integer'],
        ];
    }
}

