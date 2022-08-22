<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Task
    {
    }

    public function create(array $attributes): Task
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    /**
     * @param string $userId
     * @return Collection|Task[]
     */
    public function getAllByUser(string $userId): Collection
    {
        return $this->getQueryBuilder()
            ->where(Task::USER_ID_COLUMN, $userId)
            ->get();
    }

    /**
     * @param string $categoryId
     * @return Collection|Task[]
     */
    public function getAllByCategory(string $categoryId): Collection
    {
        return $this->getQueryBuilder()
            ->where(Task::CATEGORY_ID_COLUMN, $categoryId)
            ->get();
    }

    public function findByUserAndId(string $userId, string $taskId): ?Task
    {
        return $this->getQueryBuilder()
            ->where(Task::USER_ID_COLUMN, $userId)
            ->where(Task::ID_COLUMN, $taskId)
            ->first();
    }

    public function update(string $taskId, array $attributes): bool
    {
        return $this->getQueryBuilder()
                ->where(Task::ID_COLUMN, $taskId)
                ->update($attributes) > 0;
    }

    public function deleteByUserAndId(string $userId, string $taskId): bool
    {
        return $this->getQueryBuilder()
                ->where(Task::ID_COLUMN, $taskId)
                ->where(Task::USER_ID_COLUMN, $userId)
                ->delete() > 0;
    }

    protected function getModelClass(): string
    {
        return Task::class;
    }
}
