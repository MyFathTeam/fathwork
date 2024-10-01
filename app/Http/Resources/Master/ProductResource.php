<?php

namespace App\Http\Resources\Master;

use App\Helpers\CalHelper;
use App\Http\Resources\MediaResource;
use App\Models\Master\ProductCategory;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $productcategory = ProductCategory::where('id', $this->product_category_id)->first();
        return [
            'uuid' => $this->uuid,
            'productcategory' => $productcategory->id,
            'productcategorytitle' => $productcategory->title,
            'name' => $this->name,
            'description' => $this->description,
            'media_token' => $this->getMeta('media_token'),
            'media' => MediaResource::collection($this->whenLoaded('media')),
            'is_createtable' => $this->isEditable() && Auth::user()->can('product:create'),
            'is_editable' => $this->isEditable() && Auth::user()->can('product:edit'),
            'is_deletable' => $this->isEditable() && Auth::user()->can('product:delete'),
            'is_readtable' => $this->isEditable() && Auth::user()->can('product:read'),
            'created_at' => CalHelper::toDateTime($this->created_at),
            'updated_at' => CalHelper::toDateTime($this->updated_at),
        ];
    }
}
