<?php

namespace App\Services\Core\User;

use App\Models\User;
use App\Repositories\User\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findById(string $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function create(array $attributes): User
    {
        return $this->userRepository->create($attributes);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function update(User $user, array $attributes): bool
    {
        return $this->userRepository->update($user->getId(), $attributes);
    }
}
