<?php

namespace App\Http\Requests\HealthHistory;

use Illuminate\Foundation\Http\FormRequest;

class MedicationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'           => ['required', 'integer', 'exists:users,id'],
            'medication_name'   => ['required', 'string'],
            'dosage'            => ['required', 'string'],
            'frequency'         => ['required', 'string'],
            'start_date'        => ['required', 'date'],
            'end_date'          => ['required', 'date','after_or_equal:start_date'],
            'duration'          => ['required', 'string'],
            'reason'            => ['required', 'string'],
            'is_taking'         => ['required', 'in:Yes,No'],
            'status'            => ['required', 'in:active,pending']
        ];
    }
}
