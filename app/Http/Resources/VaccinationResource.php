<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VaccinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uid'              => $this->id ?? null,
            'user_id'          => $this->user_id ?? null,
            'vaccine_name'     => $this->vaccine_name ?? null,
            'type'             => $this->type ?? null,
            'administered_date'=> $this->administered_date ?? null,
            'next_due_date'    => $this->next_due_date ?? null,
            'hospital'         => $this->hospital ?? null,
            'proof_file'       => $this->proof_file ?? null,
            'note'             => $this->note ?? null,
            'status'           => $this->status ?? null,

            'created_at'       => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'       => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
