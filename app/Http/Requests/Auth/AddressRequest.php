<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'address' => ['required', 'string', 'max:255'],
            'city'    => ['required', 'string', 'max:100'],
            'state'   => ['required', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'zipcode' => ['required', 'numeric'], 
        ];
    }
}
