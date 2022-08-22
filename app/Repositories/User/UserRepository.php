<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\AbstractEloquentRepository;

class UserRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?User
    {
        return $this->getQueryBuilder()
                    ->where(User::ID_COLUMN, $id)
                    ->first();
    }

    public function create(array $attributes): User
    {
        return $this->getQueryBuilder()
                    ->create($attributes);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->getQueryBuilder()
                    ->where(User::EMAIL_COLUMN, $email)
                    ->first();
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->getQueryBuilder()
                    ->where(User::ID_COLUMN, $id)
                    ->update($attributes) > 0;
    }

    protected function getModelClass(): string
    {
        return User::class;
    }
}
