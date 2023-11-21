<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'url' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'url' => ['required', 'string'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
        ];
    }
}
