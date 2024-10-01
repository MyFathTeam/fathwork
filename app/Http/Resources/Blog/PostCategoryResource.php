<?php

namespace App\Http\Resources\Blog;

use App\Helpers\CalHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'is_createtable' => $this->isEditable() && Auth::user()->can('postcategory:create'),
            'is_editable' => $this->isEditable() && Auth::user()->can('postcategory:edit'),
            'is_deletable' => $this->isEditable() && Auth::user()->can('postcategory:delete'),
            'is_readtable' => $this->isEditable() && Auth::user()->can('postcategory:read'),
            'created_at' => CalHelper::toDateTime($this->created_at),
            'updated_at' => CalHelper::toDateTime($this->updated_at),
        ];
    }
}
