<?php

namespace App\Concerns;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait HasStorage
{
    private function getDisk(string $visibility = 'private') : string
    {
        $disk = config('filesystems.default', 'local');

        if ($disk == 'local' && $visibility == 'public') {
            $disk = 'public';
        }

        return $disk;
    }

    public function uploadFile(
        string $path = 'files',
        string $input = 'file',
        bool|int $thumbnail = false,
        string $visibility = 'private',
        bool $url = false
    ) : string
    {
        $disk = $this->getDisk($visibility);

        $path = config('config.system.upload_prefix').$path;

        $filename = Storage::disk($disk)->putFile($path, request()->file($input), $visibility);

        if ($thumbnail) {
            $thumbnail = is_bool($thumbnail) ? 400 : $thumbnail;

            $img = \Image::make(request()->file($input))->resize($thumbnail, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbFilename = Str::of($filename)->replaceLast('.', '-thumb.');

            Storage::disk($disk)->put($thumbFilename, $img->stream(), $visibility);
        }

        return $url ? Storage::disk($disk)->url($filename) : $filename;
    }

    public function deleteFile(
        string $disk = 'local',
        bool $thumbnail = false,
        string $visibility = 'private',
        ?string $path = null,
    ) : void
    {
        if (! $path) {
            return;
        }

        $disk = $this->getDisk($visibility);

        try {
            Storage::disk($disk)->delete($path);

            if ($thumbnail) {
                $thumbFilename = Str::of($path)->replaceLast('.', '-thumb.');
                Storage::disk($disk)->delete($thumbFilename);
            }

        } catch (\Exception $e) {
        }
    }

    public function makeDirectory(string $path): void
    {
        if (Storage::exists($path)) {
            return;
        }

        Storage::makeDirectory($path);
    }

    public function getFile(
        string $path = '',
        string $default = '',
        string $visibility = 'private',
    ): string
    {
        $disk = $this->getDisk($visibility);

        if (! Storage::disk($disk)->exists($path)) {
            return $default;
        }

        return Storage::disk($disk)->url($path);
    }
}