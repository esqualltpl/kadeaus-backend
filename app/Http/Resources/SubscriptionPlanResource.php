<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $id         = $this->id ?? null;
        $name       = $this->name ?? null;
        $slug       = $this->slug ?? null;
        $description= $this->description ?? null;
        $price      = $this->price ?? null;
        $billing_period = $this->billing_period ?? null;
        $features   = $this->features ?? null;
        $is_active  = (bool) $this->is_active ?? null;

        return [
            'uid'           => $id,
            'name'          => $name,
            'slug'          => $slug,
            'description'   => $description,
            'price'         => $price,
            'billing_period'=> $billing_period,
            'features'      => $features,
            'is_active'     => $is_active,
            'created_at'    => $this->created_at?->format('d-m-Y H:i:s'),
        ];
    }
}
