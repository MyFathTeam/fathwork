<?php

namespace App\Http\Resources\Config;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $permission = Arr::getVar('permission');
        $roles = Arr::get($permission, 'roles', []);

        return [
            'uuid' => $this->uuid,
            'label' => title_case($this->name),
            'name' => $this->name,
            'is_default' => array_search(strtolower($this->name), $roles) === false ? false : true,
            'created_at' => \Cal::dateTime($this->created_at),
            'updated_at' => \Cal::dateTime($this->updated_at),
        ];
    }
}
