<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Calendar\StoreRequest;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\Task;
use App\Services\Core\Calendar\CalendarService;
use App\Services\Core\Category\CategoryService;
use App\Services\Core\Task\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class StoreController extends BaseController
{
    private CalendarService $calendarService;
    private CategoryService $categoryService;
    private TaskService $taskService;

    public function __construct(
        CalendarService $calendarService,
        CategoryService $categoryService,
        TaskService $taskService
    ) {
        $this->calendarService = $calendarService;
        $this->categoryService = $categoryService;
        $this->taskService = $taskService;
    }

    public function __invoke(StoreRequest $request): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $basketId = $request->get('basket_id');
            $basket = $this->categoryService->findByUserAndId($user, $basketId);
            if (!$basket instanceof Category) {
                return $this->withError('Basket not found!', Response::HTTP_NOT_FOUND);
            }

            $taskId = $request->get('task_id');
            if ($taskId !== null) {
                $task = $this->taskService->findByUserAndId($user, $taskId);
                if (!$task instanceof Task) {
                    return $this->withError('Idea not found!', Response::HTTP_NOT_FOUND);
                }

                if ($task->getCategoryId() !== $basket->getId()) {
                    return $this->withError('Idea does not belong to basket!', Response::HTTP_UNPROCESSABLE_ENTITY);
                }
            }

            $item = $this->calendarService->create([
                Calendar::BASKET_ID_COLUMN => $basket->getId(),
                Calendar::TASK_ID_COLUMN   => $taskId,
                Calendar::STARTS_AT_COLUMN => $request->get('starts_at'),
                Calendar::ENDS_AT_COLUMN   => $request->get('ends_at'),
            ]);

            return $this->withSuccess([
                'message' => 'Item added to calendar successfully.',
                'item'    => $item
            ]);
        } catch (Throwable $e) {
            Log::error('failed to store in calendar', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}