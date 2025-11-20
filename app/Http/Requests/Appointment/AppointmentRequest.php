<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'user_id'            => ['required', 'exists:users,id'],
            'date'               => ['required', 'date_format:Y-m-d'],
            'time'               => ['required', 'date_format:H:i'],
            'description'        => ['nullable', 'string'],
            'created_by'         => ['nullable', 'exists:users,id'],
            'rescheduled_by'     => ['nullable', 'exists:users,id'],
            'rescheduled_date'   => ['nullable', 'date_format:Y-m-d'],
            'cancelled_by'       => ['nullable', 'exists:users,id'],
            'cancelled_date'     => ['nullable', 'date_format:Y-m-d'],
            'hospital_id'        => ['required', 'exists:hospitals,id'],
            'department_id'      => ['required', 'exists:departments,id'],
            'doctor_id'          => ['required', 'exists:doctors,id'],
            'is_share_documents' => ['nullable', 'in:Yes,No'],
            'visit_type'         => ['required', 'in:In-Person,Video Call'],
            'virtual_link'       => ['nullable', 'string'],
            'note'               => ['nullable', 'string'],
            'cancel_reason'      => ['nullable', 'string'],
            'status'             => ['nullable', 'in:pending,active,completed,cancelled'],
        ];
    }
}
