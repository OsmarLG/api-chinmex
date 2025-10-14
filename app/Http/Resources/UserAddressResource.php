<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => $this->whenLoaded('user'),
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'city' => $this->city,
            'state' => [
                'id' => $this->state->id,
                'name' => $this->state->name,
                'abbreviation' => $this->state->abbreviation,
            ],
            'postal_code' => $this->postal_code,
            'country' => [
                'id' => $this->country->id,
                'name' => $this->country->name,
                'abbreviation' => $this->country->abbreviation,
            ],
            'is_default' => $this->is_default,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}