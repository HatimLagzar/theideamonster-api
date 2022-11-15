<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Services\Domain\Task\CreateTaskService;
use App\Transformers\Task\CategoryTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateTaskController extends BaseController
{
    private CreateTaskService $createTaskService;
    private CategoryTransformer $taskTransformer;

    public function __construct(CreateTaskService $createTaskService, CategoryTransformer $taskTransformer)
    {
        $this->createTaskService = $createTaskService;
        $this->taskTransformer = $taskTransformer;
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
                'task'    => $this->taskTransformer->transform($task)
            ]);
        } catch (Throwable $e) {
            Log::error('failed to create task', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later.');
        }
    }
}
