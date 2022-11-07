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

    protected function getModelClass(): string
    {
        return Calendar::class;
    }
}
