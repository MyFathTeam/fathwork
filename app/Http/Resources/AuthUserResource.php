<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
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
            'status' => $this->status,
            'roles' => $this->user_role,
            'permissions' => $this->user_permission,
            'is_super_admin' => $this->when($this->is_default, true),
            'profile' => [
                'name' => $this->name,
            ],
            'avatar' => $this->avatar,
            'preference' => $this->user_preference,
        ];
    }
}
