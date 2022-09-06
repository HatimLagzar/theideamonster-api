<?php

namespace App\Services\Domain\Task;

use App\Models\Task;
use App\Services\Core\Task\TaskService;

class MarkTaskAsDoneService
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function markAsDone(Task $task): bool
    {
        return $this->taskService->update($task, [
            Task::DONE_COLUMN => true
        ]);
    }
}