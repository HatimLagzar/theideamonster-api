<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Services\Domain\Task\CreateTaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateTaskController extends BaseController
{
    private CreateTaskService $createTaskService;

    public function __construct(CreateTaskService $createTaskService)
    {
        $this->createTaskService = $createTaskService;
    }

    public function __invoke(CreateTaskRequest $request, string $categoryId): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $task = $this->createTaskService->create(
                $user,
                intval($request->get('type')),
                $categoryId,
                $request->get('content'),
                $request->file('audio')
            );

            return $this->withSuccess([
                'message' => 'Task created successfully.',
                'task'    => $task
            ]);
        } catch (Throwable $e) {
            Log::error('failed to create task', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later.');
        }
    }
}
