<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id ?? null,
            'user_id'            => $this->user_id ?? null,
            'date'               => $this->date ?? null,
            'time'               => $this->time ?? null,
            'description'        => $this->description ?? null,

            'created_by'         => $this->created_by ?? null,
            'rescheduled_by'     => $this->rescheduled_by ?? null,
            'rescheduled_date'   => $this->rescheduled_date ?? null,

            'cancelled_by'       => $this->cancelled_by ?? null,
            'cancelled_date'     => $this->cancelled_date ?? null,

            'hospital_id'        => $this->hospital_id ?? null,
            'department_id'      => $this->department_id ?? null,
            'doctor_id'          => $this->doctor_id ?? null,

            'is_share_documents' => $this->is_share_documents ?? null,
            'visit_type'         => $this->visit_type ?? null,

            'virtual_link'       => $this->virtual_link ?? null,
            'note'               => $this->note ?? null,
            'cancel_reason'      => $this->cancel_reason ?? null,

            'status'             => $this->status ?? null,

            'created_at'         => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'         => $this->updated_at?->format('Y-m-d H:i:s'),

            'doctor'    => ['id'    => $this->doctor_id,'name'  => optional($this->doctor->user)->name,],
            'department'=> ['id'   => $this->department_id,'name' => optional($this->department)->name,],
            'hospital' => ['id'   => $this->hospital_id,'name' => optional($this->hospital->user)->name,],
        ];
    }
}
