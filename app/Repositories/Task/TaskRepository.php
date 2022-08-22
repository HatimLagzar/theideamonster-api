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

    protected function getModelClass(): string
    {
        return Task::class;
    }
}
