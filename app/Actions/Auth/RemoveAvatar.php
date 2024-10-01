<?php

namespace App\Actions\Auth;

use App\Concerns\HasStorage;
use Illuminate\Http\Request;

class RemoveAvatar
{
    use HasStorage;

    public function execute(Request $request)
    {
        $user = \Auth::user();

        $avatar = $user->getMeta('avatar');

        $this->deleteFile(
            visibility: 'public',
            path: $avatar,
        );

        $user->updateMeta(['avatar' => null]);
    }
}
