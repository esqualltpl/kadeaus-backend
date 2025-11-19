<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name'      => ['required', 'string', 'max:255'],
            'last_name'       => ['required', 'string', 'max:255'],
            'email'           => ['required', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'dob'             => ['required', 'date'],
            'gender'          => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'material_status' => ['required', Rule::in(['Single', 'Married'])],
            'phone'           => ['required', 'string', 'max:20'],
            'password'        => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'material_status.in' => 'The marital status must be either Single or Married.',
        ];
    }
}