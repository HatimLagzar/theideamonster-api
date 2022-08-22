<?php

namespace App\Services\Core\Task;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use App\Repositories\Task\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function findById(string $id): ?Task
    {
    }

    public function create(array $attributes): Task
    {
        return $this->taskRepository->create($attributes);
    }

    /**
     * @param User $user
     * @return Task[]|Collection
     */
    public function getAllByUser(User $user): Collection
    {
        return $this->taskRepository->getAllByUser($user->getId());
    }

    /**
     * @param Category $category
     * @return Task[]|Collection
     */
    public function getAllByCategory(Category $category): Collection
    {
        return $this->taskRepository->getAllByCategory($category->getId());
    }

    public function findByUserAndId(User $user, string $taskId): ?Task
    {
        return $this->taskRepository->findByUserAndId($user->getId(), $taskId);
    }

    public function update(Task $task, array $attributes): bool
    {
        return $this->taskRepository->update($task->getId(), $attributes);
    }

    public function deleteByUserAndId(User $user, string $taskId): bool
    {
        return $this->taskRepository->deleteByUserAndId($user->getId(), $taskId);
    }
}
