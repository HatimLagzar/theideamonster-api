<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Services\Core\Notification\NotificationService;
use Illuminate\Support\Facades\Log;
use Throwable;

class ListNotificationsController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function __invoke()
    {
        try {
            $notifications = $this->notificationService->getAll();

            return view('admin.notifications.index')
                ->with('notifications', $notifications);
        } catch (Throwable $e) {
            Log::error('failed show create notification page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/admin')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}