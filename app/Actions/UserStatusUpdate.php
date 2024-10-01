<?php

namespace App\Actions;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserStatusUpdate
{
    public function execute(Request $request, User $user)
    {
        if ($user->status === UserStatus::PENDING_APPROVAL->value
            && ! in_array($request->status, [
                UserStatus::ACTIVATED->value, UserStatus::DISAPPROVED->value,
            ])
        ) {
            throw ValidationException::withMessages(['message' => trans('general.errors.invalid_action')]);
        }

        if ($user->status === UserStatus::ACTIVATED->value
            && ! in_array($request->status, [
                UserStatus::BANNED->value,
            ])
        ) {
            throw ValidationException::withMessages(['message' => trans('general.errprs.invalid_action')]);
        }

        if ($user->status === UserStatus::BANNED->value
            && ! in_array($request->status, [
                UserStatus::ACTIVATED->value,
            ])
        ) {
            throw ValidationException::withMessages(['message' => trans('general.errors.invalid_action')]);
        }

        $user->status = $request->status;
        $user->save();
    }
}
