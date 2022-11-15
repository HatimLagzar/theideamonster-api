<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\Core\Notification\NotificationService;
use Illuminate\Support\Facades\Log;
use Throwable;

class DeleteNotificationController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function __invoke(Notification $notification)
    {
        try {
            $this->notificationService->delete($notification);

            return redirect()
                ->route('notifications.index')
                ->with('success', 'Notification deleted successfully');
        } catch (Throwable $e) {
            Log::error('failed delete notification', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/admin')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}