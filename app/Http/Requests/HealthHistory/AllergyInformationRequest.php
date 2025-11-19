<?php

namespace App\Http\Requests\HealthHistory;

use Illuminate\Foundation\Http\FormRequest;

class AllergyInformationRequest extends FormRequest
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
            'user_id'       => ['required', 'integer', 'exists:users,id'],
            'type'          => ['required', 'in:Food,Drug,Environmental,Other'],
            'allergy_name'  => ['required', 'string'],
            'reaction_type' => ['required', 'string'],
            'severity'      => ['required', 'in:Mild,Moderate,Serious,Severe,unknown'],
            'identify_date' => ['required', 'date'],
            'note'          => ['required', 'string'],
            'status'        => ['nullable', 'in:active,pending'],
        ];
    }
}
