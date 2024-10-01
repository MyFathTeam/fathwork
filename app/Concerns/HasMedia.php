<?php

namespace App\Concerns;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait HasMedia
{
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

    public static function bootHasMedia()
    {
        static::deleting(function (Model $model) {
            $model->media()->cursor()->each(function (Media $media) {
                if (\Storage::exists($media->name)) {
                    \Storage::delete($media->name);
                }

                $media->delete();
            });
        });
    }

    public function getMedia($uuid): Media
    {
        return $this->media()->whereUuid($uuid)->firstOrFail();
    }

    public function downloadMedia($uuid)
    {
        $media = $this->getMedia($uuid);

        if (! \Storage::exists($media->name)) {
            abort(404);
        }

        $download_path = storage_path('app/'.$media->name);

        return response()->download($download_path, $media->file_name);
    }

    public function addMedia(Request $request): void
    {
        $this->setToken($request);

        Media::whereModelType($this->getModelName())
            ->whereToken($request->media_token)
            ->where('meta->hash', $request->media_hash)
            ->where('meta->is_temp_deleted', false)
            ->whereStatus(0)
            ->update([
                'status' => 1,
                'model_id' => $this->id,
            ]);
    }

    public function updateMedia(Request $request): void
    {
        $this->addMedia($request);

        $media = Media::select('name', 'id')
            ->whereModelType($this->getModelName())
            ->whereToken($request->media_token)
            ->where('meta->is_temp_deleted', true)
            ->where('meta->delete_hash', $request->media_hash)
            ->whereModelId($this->id)
            ->get();

        $this->deleteMedia($media);

        Media::whereIn('id', $media->pluck('id')->all())->delete();
    }

    public function deleteMedia(Collection $media)
    {
        $media->each(function (Media $media) {
            if (\Storage::exists($media->name)) {
                \Storage::delete($media->name);
            }
        });
    }

    public function setToken(Request $request): void
    {
        if ($this->getMeta('media_token')) {
            return;
        }

        $meta = $this->meta;
        $meta['media_token'] = $request->media_token ?? (string) Str::uuid();
        $this->meta = $meta;
        $this->save();
    }
}
