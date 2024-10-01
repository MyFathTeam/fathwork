<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthUserResource;

class AuthController extends Controller
{
    /**
     * Get logged in user
     */
    public function me()
    {
        return AuthUserResource::make(\Auth::user());
    }
}
