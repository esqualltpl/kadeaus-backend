<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class MedicalDetailRequest extends FormRequest
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
            'patient_id' => ['required', 'exists:users,id'],

            'height'     => ['required', 'string', 'max:50'],   
            'weight'     => ['required', 'string', 'max:50'],
            'blood_type' => ['required', 'in:A-,B+,B-,AB+,AB-,O+,O-'],
            'pregnancy'  => ['required', 'in:Yes,No'],
            // trimester only required when pregnant
            'trimester'  => ['nullable','required_if:pregnancy,Yes','in:1st Trimester,2nd Trimester,3rd Trimester'],
        ];
    }
}
