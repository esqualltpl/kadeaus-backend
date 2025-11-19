<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $id         = $this->id ?? null;
        $first_name = $this->first_name ?? null;
        $last_name  = $this->last_name ?? null;
        $name       = $this->name ?? null;
        $email      = $this->email ?? null;
        $phone      = $this->phone ?? null;
        $dob        = $this->dob? Carbon::parse($this->dob)->format('d-m-Y'): null;
        $gender     = $this->gender ?? null;
        $material_status    = $this->material_status ?? null;
        $address    = $this->address ?? null;
        $city       = $this->city ?? null;
        $state      = $this->state ?? null;
        $country    = $this->country ?? null;
        $zipcode    = $this->zipcode ?? null;
        $avatar     = $this->avatar ?? null;
        $status     = $this->status ?? null;


        return [
            'uid'            => $id,
            'first_name'     => $first_name,
            'last_name'      => $last_name,
            'name'           => $name,
            'email'          => $email,
            'phone'          => $phone,
            'date_of_birth'  => $dob,
            'gender'         => $gender,
            'marital_status' => $material_status, 
            'address'        => $address,
            'city'           => $city,
            'state'          => $state,
            'country'        => $country,
            'zipcode'        => $zipcode,
            'avatar'         => $avatar, 
            'status'         => $status,
            'created_at'     => $this->created_at ? $this->created_at->format('d-m-Y H:i:s') : null,
            'updated_at'     => $this->updated_at ? $this->updated_at->format('d-m-Y H:i:s') : null,
            'token'          => $this->token ?? null,
        ];
    }
}
