<?php

namespace App\Services\Domain\Task;

use App\Models\Task;
use App\Services\Core\Task\TaskService;

class ToggleTaskStatusService
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function toggle(Task $task): bool
    {
        return $this->taskService->update($task, [
            Task::DONE_COLUMN => !$task->isDone()
        ]);
    }
}