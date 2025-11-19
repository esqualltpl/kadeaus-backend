<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllergyInformationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uid'           => (int) $this->id,
            'type'          => $this->type ?? null,
            'allergy_name'  => $this->allergy_name ?? null,
            'reaction_type' => $this->reaction_type ?? null,
            'severity'      => $this->severity ?? null,
            'identify_date' => $this->identify_date ?? null,
            'note'          => $this->note ?? null,
            'status'        => $this->status ?? null,
            'created_at'      => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'      => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
