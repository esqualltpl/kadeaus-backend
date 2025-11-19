<?php

namespace App\Http\Requests\HealthHistory;

use Illuminate\Foundation\Http\FormRequest;

class MedicalHistoryRequest extends FormRequest
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
            'user_id'   => ['required', 'integer', 'exists:users,id'],
            'disease'   => ['required', 'string'],
            'diagnosis_date' => ['required', 'date'],
            'status'    => ['required', 'in:Active,Resolved,Pending, Unknown'],
            'description' => ['required', 'string'],
            'hospital'  => ['required', 'string'],
            'report_file' => ['required', 'file'], 
        ];
    }
}
