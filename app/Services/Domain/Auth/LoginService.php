<?php

namespace App\Services\Domain\Auth;

use App\Models\User;
use App\Services\Domain\Auth\Exceptions\IncorrectCredentialsException;
use function auth;

class LoginService
{
    /**
     * @throws IncorrectCredentialsException
     */
    public function login(
        string $email,
        string $password,
        string $guard = 'api'
    ): string {
        $token = auth()->guard($guard)->attempt(
            [
                User::EMAIL_COLUMN => $email,
                User::PASSWORD_COLUMN => $password,
            ]
        );

        if (is_string($token)) {
            return $token;
        }

        throw new IncorrectCredentialsException();
    }

    public function logout(string $guard = 'api'): bool
    {
        auth()->guard($guard)->logout();

        return true;
    }
}
