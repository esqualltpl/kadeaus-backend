<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $id = $this->id ?? null;
        $user_id    = $this->user_id ?? null;
        $weight     = $this->weight ?? null;
        $date       = $this->date ?? null;
        $time       = $this->time ?? null;
        $status     = $this->status ?? null;

        return [
            'uid'       => $id,
            'user_id'   => $user_id,
            'weight'    => $weight,
            'date'      => $date,
            'time'      => $time,
            'status'    => $status,
            'created_at'   => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'   => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
