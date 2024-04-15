<?php

namespace App\Http\Resources\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'external_identifier' => $this->external_identifier,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'avatar' => AvatarResource::collection($this->whenLoaded('avatars')),
        ];
    }
}
