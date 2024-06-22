<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityUpdateRequest extends FormRequest
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
            'student_id' => ['required', 'exists:students,id'],
            'activity_type_id' => ['required', 'exists:activity_types,id'],
            'activityreport' => ['file', 'max:1024'],
            'certificate' => ['file', 'max:1024'],
        ];
    }
}
