<?php

namespace App\Actions\Auth;

use App\Http\Resources\AuthUserResource;
use App\Models\FailedLoginAttempt;
use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Login
{
    use ThrottlesLogins;

    public function maxAttempts(): int
    {
        return config('config.auth.login_throttle_max_attempts', 5);
    }

    public function decayMinutes(): int
    {
        return config('config.auth.login_throttle_lock_timeout', 2);
    }

    public function username(): string
    {
        return 'email';
    }

    public function execute(Request $request): array
    {
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($request->device_name) {
            $user = $this->validateDeviceLogin($request);
            $token = $user->createToken($request->device_name)->plainTextToken;
        } else {
            $user = $this->validateLogin($request);
            $token = null;
        }

        $this->clearLoginAttempts($request);

        $user->validateStatus();

        $user->setTwoFactor();

        activity('user')->log('logged_in');

        return [
            'message' => __('auth.login.logged_in'),
            'user' => AuthUserResource::make($user),
            'token' => $token,
            'two_factor_security' => config('config.auth.enable_two_factor_security') ? true : false,
        ];
    }

    /**
     * Validate login credentials
     */
    public function validateLogin(Request $request): User
    {
        $credentials = $this->getCredentials($request);

        if (! \Auth::attempt($credentials, $request->remember_me)) {
            $this->failedLogin($request);
        }

        return \Auth::user();
    }

    private function getUser($credentials = []): ?User
    {
        $user = User::query()
            ->when(Arr::get($credentials, 'email'), function ($q, $email) {
                $q->whereEmail($email);
            })->when(Arr::get($credentials, 'username'), function ($q, $username) {
                $q->whereUsername($username);
            })->first();

        return $user;
    }

    /**
     * Validate device login credentials
     */
    public function validateDeviceLogin(Request $request): User
    {
        $credentials = $this->getCredentials($request);

        $user = $this->getUser($credentials);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            $this->failedLogin($request);
        }

        return $user;
    }

    /**
     * Get credentials
     */
    private function getCredentials(Request $request): array
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->email, 'password' => $request->password];
        }

        return ['username' => $request->email, 'password' => $request->password];
    }

    /**
     * Failed login
     */
    private function failedLogin(Request $request): void
    {
        FailedLoginAttempt::forceCreate([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'meta' => [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ],
        ]);

        $this->incrementLoginAttempts($request);
        throw ValidationException::withMessages(['email' => __('auth.login.errors.failed')]);
    }
}
