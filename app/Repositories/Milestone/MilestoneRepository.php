<?php

namespace App\Repositories\Milestone;

use App\Models\Milestone;
use App\Repositories\AbstractEloquentRepository;

class MilestoneRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Milestone
    {
    }

    public function create(array $attributes): Milestone
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    protected function getModelClass(): string
    {
        return Milestone::class;
    }
}
