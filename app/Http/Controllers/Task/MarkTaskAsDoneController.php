<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\BaseController;
use App\Models\Task;
use App\Services\Core\Task\TaskService;
use App\Services\Domain\Task\MarkTaskAsDoneService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class MarkTaskAsDoneController extends BaseController
{
    private MarkTaskAsDoneService $markTaskAsDoneService;
    private TaskService $taskService;

    public function __construct(
        MarkTaskAsDoneService $markTaskAsDoneService,
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

            $this->markTaskAsDoneService->markAsDone($task);

            return $this->withSuccess([
                'message' => 'Task marked as done!',
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
