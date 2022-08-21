<?php

namespace App\Services\Domain\User;

use App\Models\User;
use App\Services\Core\User\UserService;
use App\Services\Domain\User\Exceptions\InvalidTokenException;

class VerifyUserService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws InvalidTokenException
     */
    public function verify(User $user, string $token): bool
    {
        if ($user->getVerificationToken() !== $token) {
            throw new InvalidTokenException();
        }

        return $this->userService->update($user, [
            User::EMAIL_VERIFIED_AT_COLUMN => date('Y-m-d H:i:s')
        ]);
    }
}