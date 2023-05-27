<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowInstructionPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'instruction_id' => $this->id,
            'run_mode' => $this->run_mode,
            'speed' => $this->speed,
            'location' => [
                'latitude' => $this->lat,
                'longitude' => $this->lng,
            ],
            'plan' => new PlanResource($this->plan)
        ];
    }
}
