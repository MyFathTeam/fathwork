<?php

use App\Support\SetConfig;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

if (! app()->environment('testing')) {
    (new SetConfig)->set();
}

Broadcast::channel('users.{uuid}', function ($user, $userUuid) {
    return $user->uuid == $userUuid;
});
