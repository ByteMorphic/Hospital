<?php

namespace App\Http\Resources\Generic;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class GenericResource extends JsonResource
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
            'generic_name' => $this->generic_name,
            'generic_description' => $this->generic_description,
            'therapeutic_class' => $this->therapeutic_class,
            'generic_category' => $this->generic_category,
            'generic_subcategory' => $this->generic_subcategory,
            'generic_notes' => $this->generic_notes,
            'generic_status' => $this->generic_status,
        ];
    }
}
