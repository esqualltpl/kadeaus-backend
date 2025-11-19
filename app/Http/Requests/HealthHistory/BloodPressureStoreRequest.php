<?php

namespace App\Http\Requests\HealthHistory;

use Illuminate\Foundation\Http\FormRequest;

class BloodPressureStoreRequest extends FormRequest
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
            'user_id'   => ['required', 'exists:users,id'],
            'systolic'  => ['required', 'string'],
            'diastolic' => ['required', 'string'],
            'date'      => ['required', 'date_format:Y-m-d'],
            'time'      => ['required', 'date_format:H:i'],
            'blood_pressure_status' => ['required', 'in:High,Normal,Low'],
        ];
    }
}
