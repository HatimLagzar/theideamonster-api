<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\UpdateRequest;
use App\Models\Notification;
use App\Services\Core\Notification\NotificationService;
use Illuminate\Support\Facades\Log;
use Throwable;

class UpdateNotificationController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function __invoke(UpdateRequest $request, Notification $notification)
    {
        try {
            $this->notificationService->update($notification, [
                Notification::CONTENT_COLUMN => $request->get('content')
            ]);

            return redirect()
                ->route('notifications.index')
                ->with('success', 'Notification updated successfully');
        } catch (Throwable $e) {
            Log::error('failed update notification', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/admin')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}