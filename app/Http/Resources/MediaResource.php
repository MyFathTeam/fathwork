<?php

namespace App\Http\Resources;

use App\Helpers\SysHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $fileSize = SysHelper::fileSize($this->getMeta('size'));

        return [
            'uuid' => $this->uuid,
            'file' => [
                'name' => $this->file_name,
                'size' => $fileSize,
            ],
            'name' => $this->file_name,
            'status' => $this->status ? 'uploaded' : 'waiting',
            'mime' => $this->getMeta('mime'),
            'icon' => $this->getIcon(),
            'url' => url('/'),
            'size' => $fileSize,
        ];
    }
}
