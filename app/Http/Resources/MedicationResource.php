<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uid'             => (int) $this->id,
            'user_id'         => $this->user_id ?? null,
            'medication_name' => $this->medication_name ?? null,
            'dosage'          => $this->dosage ?? null,
            'frequency'       => $this->frequency ?? null,
            'start_date'      => $this->start_date ?? null,
            'end_date'        => $this->end_date ?? null,
            'duration'        => $this->duration ?? null,
            'reason'          => $this->reason ?? null,
            'is_taking'       => $this->is_taking ?? null,
            'status'          => $this->status ?? null,

            'created_at'      => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'      => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
