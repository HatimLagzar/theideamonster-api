<?php

namespace App\Repositories\Milestone;

use App\Models\Milestone;
use App\Repositories\AbstractEloquentRepository;

class MilestoneRepository extends AbstractEloquentRepository
{
    public function findById(string $userId, string $id): ?Milestone
    {
        return $this->getQueryBuilder()
            ->where(Milestone::USER_ID_COLUMN, $userId)
            ->where(Milestone::ID_COLUMN, $id)
            ->first();
    }

    public function create(array $attributes): Milestone
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    public function delete(string $id): bool
    {
        return $this->getQueryBuilder()
                ->where(Milestone::ID_COLUMN, $id)
                ->delete() > 0;
    }

    protected function getModelClass(): string
    {
        return Milestone::class;
    }
}
