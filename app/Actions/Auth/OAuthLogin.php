<?php

namespace App\Actions\Auth;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class OAuthLogin
{
    public function execute(string $provider): void
    {
        $providerUser = Socialite::driver($provider)->user();

        $user = User::whereEmail($providerUser->email)->first();

        if (! $user) {
            $user = User::forceCreate([
                'email' => $providerUser->email,
            ]);

            $user->name = $providerUser->name;
            $user->status = 'activated';
            $user->meta = ['oauth_provider' => $provider];
            $user->save();

            $user->assignRole('user');
        }

        \Auth::login($user);
    }
}
