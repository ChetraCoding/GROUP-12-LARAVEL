<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DroneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'drone_id' => $this->id,
            'code' => $this->code,
            'battery' => $this->battery,
            'payload' => $this->payload,
            'location' => [
                'latitude' => $this->lat,
                'longitude' => $this->lng,
            ],
            'user_id' => $this->user_id,
        ];
    }
}
