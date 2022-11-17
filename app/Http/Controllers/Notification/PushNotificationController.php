<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\Core\Notification\NotificationService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class PushNotificationController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function __invoke(Notification $notification)
    {
        try {
            $response = Http::withHeaders([
                'accept'        => 'application/json',
                'content-type'  => 'application/json',
                'Authorization' => 'Basic ' . env('ONESIGNAL_API_KEY'),
            ])->post('https://onesignal.com/api/v1/notifications', [
                'included_segments' => ['Subscribed Users'],
                'contents'          => ['en' => $notification->getContent()],
                'app_id'            => env('ONESIGNAL_APP_ID'),
            ]);

            if ($response->ok()) {
                $this->notificationService->increment($notification, Notification::TIMES_SENT_COLUMN);

                return redirect()
                    ->route('notifications.index')
                    ->with('success', 'Notification sent successfully');
            }

            return redirect()
                ->route('notifications.index')
                ->with('error', 'Failed to send notification, retry later!');
        } catch (Throwable $e) {
            Log::error('failed to push notification', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/admin')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}