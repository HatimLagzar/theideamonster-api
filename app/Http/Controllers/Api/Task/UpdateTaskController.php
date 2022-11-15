<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Services\Core\Task\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UpdateTaskController extends BaseController
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function __invoke(UpdateTaskRequest $request, string $taskId): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $task = $this->taskService->findByUserAndId($user, $taskId);
            if (!$task instanceof Task) {
                return $this->withError('Task does not exist!', Response::HTTP_NOT_FOUND);
            }

            $this->taskService->update($task, [
                Task::CONTENT_COLUMN => $request->get('content'),
                Task::USER_ID_COLUMN => $user->getId(),
            ]);

            return $this->withSuccess([
                'message' => 'Task updated successfully.',
            ]);
        } catch (Throwable $e) {
            Log::error('failed to update task', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later.');
        }
    }
}
