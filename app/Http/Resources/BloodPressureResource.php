<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BloodPressureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id ?? null,
            'user_id'   => $this->user_id ?? null,
            'systolic'  => $this->systolic ?? null,
            'diastolic' => $this->diastolic ?? null,
            'date'      => $this->date ?? null,
            'time'      => $this->time ?? null,
            'blood_pressure_status' => $this->blood_pressure_status,
            'status'    => $this->status ?? null,
            'created_at'   => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'   => $this->updated_at?->format('Y-m-d H:i:s'),
         ];
    }
}
