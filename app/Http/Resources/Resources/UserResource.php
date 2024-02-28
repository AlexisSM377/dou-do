<?php

namespace App\Http\Resources\Resources;

use App\Http\Resources\Resources\NotificationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/**
 * Resource from Users
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'external_identifier' => $this->external_identifier,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'birthdate' => $this->birthdate,
            'notifications' => NotificationResource::collection($this->whenLoaded('notifications')),
            'avatar' => AvatarResource::collection($this->whenLoaded('avatars')),
        ];
    }
}
