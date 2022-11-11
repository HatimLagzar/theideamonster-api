<?php

namespace App\Repositories\Calendar;

use App\Models\Calendar;
use App\Repositories\AbstractEloquentRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

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

    public function delete(string $userId, string $id): bool
    {
        return $this->getQueryBuilder()
                ->where(Calendar::ID_COLUMN, $id)
                ->where(Calendar::USER_ID_COLUMN, $userId)
                ->delete() > 0;
    }

    /**
     * @param string $userId
     * @return Calendar[]|Collection
     */
    public function getByUser(string $userId): Collection
    {
        return $this->getQueryBuilder()
            ->where(Calendar::USER_ID_COLUMN, $userId)
            ->orderBy(Calendar::STARTS_AT_COLUMN, 'ASC')
            ->get();
    }

    /**
     * @param string $userId
     * @param Carbon $date
     * @return Calendar[]|Collection
     */
    public function getByUserAndDate(string $userId, Carbon $date): Collection
    {
        return $this->getQueryBuilder()
            ->where(Calendar::USER_ID_COLUMN, $userId)
            ->where(function ($query) use ($date) {
                $query->whereDate(Calendar::STARTS_AT_COLUMN, '<=', $date->startOfDay())
                    ->whereDate(Calendar::ENDS_AT_COLUMN, '>=', $date->endOfDay());
            })
            ->orderBy(Calendar::STARTS_AT_COLUMN, 'ASC')
            ->get();
    }

    /**
     * @param string $userId
     * @return Calendar[]|Collection
     */
    public function getByUserAndUncategorized(string $userId): Collection
    {
        return $this->getQueryBuilder()
            ->whereNull(Calendar::ENDS_AT_COLUMN)
            ->whereNull(Calendar::STARTS_AT_COLUMN)
            ->where(Calendar::USER_ID_COLUMN, $userId)
            ->get();
    }

    protected function getModelClass(): string
    {
        return Calendar::class;
    }
}
