<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\BaseController;
use App\Services\Core\Calendar\CalendarService;
use App\Services\Core\Category\CategoryService;
use App\Services\Core\Task\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ListController extends BaseController
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

    public function __invoke(): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $calendar = $this->calendarService->getByUser($user);

            return $this->withSuccess([
                'message'  => 'Item added to calendar successfully.',
                'calendar' => $calendar
            ]);
        } catch (Throwable $e) {
            Log::error('failed to list calendar', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}