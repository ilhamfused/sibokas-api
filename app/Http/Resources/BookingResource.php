<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'time_in' => $this->time_in,
            'time_out' => $this->time_out,
            'status' => $this->status,
            'student_id' => $this->student_id,
            'created_at' => $this->created_at,
            'classroom' => $this->whenLoaded('classroom'),
        ];
    }
}
