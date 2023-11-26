<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
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
            'name' => $this->name,
            'name_alias' => $this->name_alias,
            'photo' => $this->photo,
            'status' => $this->status,
            'pic_room' => $this->whenLoaded('picRoom'),
            'building' => $this->whenLoaded('building'),
        ];
    }
}
