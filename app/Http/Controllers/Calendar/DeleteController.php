<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\BaseController;
use App\Models\Calendar;
use App\Services\Core\Calendar\CalendarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class DeleteController extends BaseController
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

            $calendar = $this->calendarService->findByUserAndId($user, $id);
            if (!$calendar instanceof Calendar) {
                return $this->withError('Calendar not found!', Response::HTTP_NOT_FOUND);
            }

            $this->calendarService->delete($user, $calendar->getId());

            return $this->withSuccess([
                'message' => 'Calendar Item deleted successfully.',
            ]);
        } catch (Throwable $e) {
            Log::error('failed to delete item from calendar', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}