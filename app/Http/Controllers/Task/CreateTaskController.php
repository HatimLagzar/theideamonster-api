<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Models\Task;
use App\Services\Core\Task\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateTaskController extends BaseController
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function __invoke(CreateTaskRequest $request, string $categoryId): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $task = $this->taskService->create([
                Task::NAME_COLUMN => $request->get('name'),
                Task::USER_ID_COLUMN => $user->getId(),
                Task::CATEGORY_ID_COLUMN => $categoryId,
            ]);

            return $this->withSuccess([
                'message' => 'Task created successfully.',
                'task' => $task
            ]);
        } catch (Throwable $e) {
            Log::error('failed to create task', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later.');
        }
    }
}
