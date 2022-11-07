<?php

namespace App\Repositories\Calendar;

use App\Models\Calendar;
use App\Repositories\AbstractEloquentRepository;

class CalendarRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Calendar
    {
        return $this->getQueryBuilder()
            ->where(Calendar::ID_COLUMN, $id)
            ->first();
    }

    public function create(array $attributes): Calendar
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    public function findByUserAndId(string $userId, string $id): ?Calendar
    {
        return $this->getQueryBuilder()
            ->where(Calendar::ID_COLUMN, $id)
            ->where(Calendar::USER_ID_COLUMN, $userId)
            ->first();
    }

    public function update(string $id, array $attributes): bool
    {
        return $this->getQueryBuilder()
                ->where(Calendar::ID_COLUMN, $id)
                ->update($attributes) > 0;
    }

    protected function getModelClass(): string
    {
        return Calendar::class;
    }
}
