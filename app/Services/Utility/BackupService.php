<?php

namespace App\Services\Utility;

use Illuminate\Validation\ValidationException;

class BackupService
{
    public function deletable($uuid = null): void
    {
        if (! \Auth::user()->is_default) {
            throw ValidationException::withMessages(['message' => trans('user.errors.permission_denied')]);
        }
    }

    public function delete($uuid = null): void
    {
        if (! \Storage::exists('backup/'.$uuid)) {
            throw ValidationException::withMessages(['message' => trans('general.errors.invalid_action')]);
        }

        \Storage::delete('backup/'.$uuid);
    }
}
