<?php

namespace App\Repositories\Delegable;

use App\Models\Delegable;
use App\Repositories\AbstractEloquentRepository;

class DelegableRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Delegable
    {
    }

    public function create(array $attributes): Delegable
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    protected function getModelClass(): string
    {
        return Delegable::class;
    }
}
