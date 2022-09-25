<?php

namespace App\Repositories\Profile;

use App\Models\Profile;
use App\Repositories\AbstractEloquentRepository;

class ProfileRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Profile
    {
    }

    public function create(array $attributes): Profile
    {
    }

    public function getOrCreate(string $name, string $job): Profile
    {
        return $this->getQueryBuilder()
            ->firstOrCreate([
                Profile::NAME_COLUMN => $name,
                Profile::JOB_COLUMN  => $job,
            ]);
    }

    protected function getModelClass(): string
    {
        return Profile::class;
    }
}
