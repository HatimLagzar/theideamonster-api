<?php

namespace App\Services\Domain\Auth;

use App\Mail\EmailVerificationMail;
use App\Models\User;
use App\Services\Core\User\UserService;
use App\Services\Domain\Auth\Exceptions\EmailAlreadyInUseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws EmailAlreadyInUseException
     */
    public function register(string $firstName, string $lastName, string $email, string $password, int $gender): User
    {
        $firstName = htmlspecialchars($firstName);
        $lastName = htmlspecialchars($lastName);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($password);

        $existingAccount = $this->userService->findByEmail($email);
        if ($existingAccount instanceof User) {
            throw new EmailAlreadyInUseException();
        }

        $user = $this->userService->create([
            User::FIRST_NAME_COLUMN => $firstName,
            User::LAST_NAME_COLUMN => $lastName,
            User::EMAIL_COLUMN => $email,
            User::PASSWORD_COLUMN => Hash::make($password),
            User::VERIFICATION_TOKEN_COLUMN => Str::random(60),
            User::TYPE_COLUMN => User::NORMAL_TYPE,
            User::GENDER_COLUMN => $gender,
        ]);

        Mail::to($user)->queue(new EmailVerificationMail($user));

        return $user;
    }
}
