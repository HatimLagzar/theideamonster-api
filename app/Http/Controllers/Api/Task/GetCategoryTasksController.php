<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Api\BaseController;
use App\Models\Category;
use App\Services\Core\Category\CategoryService;
use App\Services\Core\Task\TaskService;
use App\Transformers\Task\TaskTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class GetCategoryTasksController extends BaseController
{
    private TaskService $taskService;
    private CategoryService $categoryService;
    private TaskTransformer $taskTransformer;

    public function __construct(
        TaskService $taskService,
        CategoryService $categoryService,
        TaskTransformer $taskTransformer
    ) {
        $this->taskService = $taskService;
        $this->categoryService = $categoryService;
        $this->taskTransformer = $taskTransformer;
    }

    public function __invoke(string $categoryId): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $category = $this->categoryService->findByUserAndId($user, $categoryId);
            if (!$category instanceof Category) {
                return $this->withError('Category does not exist!', Response::HTTP_NOT_FOUND);
            }

            $tasks = $this->taskService->getAllByCategory($category);

            return $this->withSuccess([
                'message' => 'Tasks fetched successfully.',
                'tasks' => $this->taskTransformer->transformMany($tasks)
            ]);
        } catch (Throwable $e) {
            Log::error('failed to fetch tasks', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}