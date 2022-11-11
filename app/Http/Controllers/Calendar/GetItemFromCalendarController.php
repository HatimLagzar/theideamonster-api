<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\BaseController;
use App\Services\Core\Calendar\CalendarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class GetItemFromCalendarController extends BaseController
{
    private CalendarService $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function __invoke(string $id): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $item = $this->calendarService->findById($user, $id);

            return $this->withSuccess([
                'message' => 'Calendar item fetched successfully.',
                'item'    => $item
            ]);
        } catch (Throwable $e) {
            Log::error('failed to fetch calendar item', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}