<?php

namespace App\Http\Requests\V1\Task;


use Illuminate\Foundation\Http\FormRequest;

class RearrangeTasksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "tasks" => "required|array|min:1",
            "tasks.*.task_id" => "required",
            "tasks.*.distributor_id" => "required|exists:distributors,id",
        ];
    }
}
