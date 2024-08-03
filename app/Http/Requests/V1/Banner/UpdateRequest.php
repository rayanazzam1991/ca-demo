<?php

namespace App\Http\Requests\V1\Banner;

use App\Core\Banner\BannerPositionEnum;
use App\Core\Banner\BannerTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'title' => ['required','min:1','max:150'],
            'header_ar' => ['nullable','string','min:1','max:150'],
            'header_en' => ['nullable','string','min:1','max:150'],
            'sub_header_ar' => ['nullable','string','min:1','max:150'],
            'sub_header_en' => ['nullable','string','min:1','max:150'],
            'files' => ['sometimes','array'],
            'files.*' => ['sometimes', 'mimes:jpg,jpeg,png,svg,webp','max:10000'],
            'filesToDelete' => ['sometimes','array'],
            'filesToDelete.*' => ['sometimes','integer', 'exists:medias,id'],
        ];
    }
}