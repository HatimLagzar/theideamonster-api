<?php

namespace App\Repositories\Delegable;

use App\Models\Delegable;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class DelegableRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Delegable
    {
        return $this->getQueryBuilder()
            ->where(Delegable::ID_COLUMN, $id)
            ->first();
    }

    public function create(array $attributes): Delegable
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    /**
     * @return Delegable[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->getQueryBuilder()
            ->get();
    }

    /**
     * @param string $userId
     * @return Delegable[]|Collection
     */
    public function getAllByUser(string $userId): Collection
    {
        return $this->getQueryBuilder()
            ->where(Delegable::USER_ID_COLUMN, $userId)
            ->get();
    }

    public function delete(string $userId, string $delegableId): bool
    {
        return $this->getQueryBuilder()
                ->where(Delegable::ID_COLUMN, $delegableId)
                ->where(Delegable::USER_ID_COLUMN, $userId)
                ->delete() > 0;
    }

    protected function getModelClass(): string
    {
        return Delegable::class;
    }
}
