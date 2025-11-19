<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function Termwind\parse;

class MedicalHistoryResource extends JsonResource
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
            'disease'         => $this->disease ?? null,
            'diagnosis_date'  => $this->diagnosis_date ?? null,
            'status'          => $this->status ?? null,
            'description'     => $this->description ?? null,
            'hospital_id'     => $this->hospital ?? null,
            'report_file'     => $this->report_file ?? null,

            'created_at'      => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'      => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
