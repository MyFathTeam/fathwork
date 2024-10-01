<?php

namespace App\Http\Resources;

use App\Http\Resources\Config\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'username' => $this->username,
            'email' => $this->email,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'profile' => [
                'name' => $this->name,
            ],
        ];
    }
}
