<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'plan_id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'datetime' => $this->datetime,
            'area' => $this->area,
            'density' => $this->density,
            'map' => new MapResource($this->map),
            'user_id' => $this->user_id,
        ];
    }
}
