<?php

namespace App\Repositories\DelegableTask;

use App\Models\DelegableTask;
use App\Repositories\AbstractEloquentRepository;

class DelegableTaskRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?DelegableTask
    {
    }

    public function create(array $attributes): DelegableTask
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    protected function getModelClass(): string
    {
        return DelegableTask::class;
    }
}
