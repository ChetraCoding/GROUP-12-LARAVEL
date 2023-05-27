<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowMapResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'map_id' => $this->id,
            'farm' => new FarmResource($this->farm),
            'create_by_drone' => $this->drone->code ?? null,
            'image' => $this->image ?? null,
        ];
    }
}
