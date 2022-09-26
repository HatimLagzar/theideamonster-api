<?php

namespace App\Repositories\Profile;

use App\Models\Profile;
use App\Repositories\AbstractEloquentRepository;

class ProfileRepository extends AbstractEloquentRepository
{
    public function findById(string $userId, string $id): ?Profile
    {
        return $this->getQueryBuilder()
            ->where(Profile::ID_COLUMN, $id)
            ->where(Profile::USER_ID_COLUMN, $userId)
            ->first();
    }

    public function create(array $attributes): Profile
    {
    }

    public function getOrCreate(string $job, string $userId): Profile
    {
        return $this->getQueryBuilder()
            ->firstOrCreate([
                Profile::JOB_COLUMN     => $job,
                Profile::USER_ID_COLUMN => $userId,
            ]);
    }

    public function update(string $id, array $attributes): bool
    {
        return $this->getQueryBuilder()
                ->where(Profile::ID_COLUMN, $id)
                ->update($attributes) > 0;
    }

    protected function getModelClass(): string
    {
        return Profile::class;
    }
}
