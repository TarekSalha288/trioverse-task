<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
            'status' => $this->status,
            'user' => $this->user,
            'replays' => ReplayResource::collection($this->whenLoaded('replays')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
