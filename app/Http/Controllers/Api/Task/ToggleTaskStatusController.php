<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Api\BaseController;
use App\Models\Task;
use App\Services\Core\Task\TaskService;
use App\Services\Domain\Task\ToggleTaskStatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ToggleTaskStatusController extends BaseController
{
    private ToggleTaskStatusService $markTaskAsDoneService;
    private TaskService $taskService;

    public function __construct(
        ToggleTaskStatusService $markTaskAsDoneService,
        TaskService $taskService
    ) {
        $this->markTaskAsDoneService = $markTaskAsDoneService;
        $this->taskService = $taskService;
    }

    public function __invoke(string $taskId): JsonResponse
    {
        try {
            $task = $this->taskService->findById($taskId);
            if (!$task instanceof Task) {
                return $this->withError('Task not found!');
            }

            $this->markTaskAsDoneService->toggle($task);

            return $this->withSuccess([
                'message' => 'Task status toggled!',
            ]);
        } catch (Throwable $e) {
            Log::error('failed to mark task as done', [
                'error_message' => $e->getMessage()
            ]);

            return $this->withSuccess([
                'message' => 'Error occurred, please retry later!'
            ]);
        }
    }
}
