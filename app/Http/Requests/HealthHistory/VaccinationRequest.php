<?php

namespace App\Http\Requests\HealthHistory;

use Illuminate\Foundation\Http\FormRequest;

class VaccinationRequest extends FormRequest
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
            'user_id'           => 'required|exists:users,id',
            'vaccine_name'      => 'required|string|max:255',
            'type'              => 'required|in:Childhood,Adult,Travel,Booster,Unknown',
            'administered_date' => 'required|date',
            'next_due_date'     => 'required|date|after_or_equal:administered_date',
            'hospital'          => 'required|string|max:255',
            'proof_file'        => 'required','file',
            'note'              => 'nullable|string',
            'status'            => 'required|in:active,pending',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'The selected user does not exist.',
            'vaccine_name.required' => 'Vaccine name is required.',
            'type.in' => 'Invalid vaccine type selected.',
            'administered_date.date' => 'Administered date must be a valid date.',
            'next_due_date.date' => 'Next due date must be a valid date.',
            'next_due_date.after_or_equal' => 'Next due date must be on or after the administered date.',
            'proof_file.mimes' => 'The proof file must be an image or PDF.',
        ];
    }
}
