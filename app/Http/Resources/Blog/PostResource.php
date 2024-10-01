<?php

namespace App\Http\Resources\Blog;

use App\Helpers\CalHelper;
use App\Http\Resources\MediaResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserSummaryResource;
use App\Models\Blog\PostCategory;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $category = PostCategory::where('id', $this->post_category_id)->first();
        return [
            'uuid' => $this->uuid,
            'postcategory' => $category->id,
            'postcategorytitle' => $category->title,
            'user' => $this->user_id ? UserSummaryResource::make($this->user) : null,
            'name' => $this->name,
            'description' => $this->description,
            'media_token' => $this->getMeta('media_token'),
            'media' => MediaResource::collection($this->whenLoaded('media')),
            'is_createtable' => $this->isEditable() && Auth::user()->can('post:create'),
            'is_editable' => $this->isEditable() && Auth::user()->can('post:edit'),
            'is_deletable' => $this->isEditable() && Auth::user()->can('post:delete'),
            'is_readtable' => $this->isEditable() && Auth::user()->can('post:read'),
            'created_at' => CalHelper::toDateTime($this->created_at),
            'updated_at' => CalHelper::toDateTime($this->updated_at),
        ];
    }
}
