<?php

namespace App\Http\Resources\Ward;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WardResource extends JsonResource
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
            'ward_name' => $this->ward_name,
            'ward_description' => $this->ward_description,
            'ward_capacity' => $this->ward_capacity,
            'ward_status' => $this->ward_status,
            'created_at' => $this->created_at,
        ];
    }
}
