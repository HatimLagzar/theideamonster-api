<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\StoreRequest;
use App\Models\Notification;
use App\Services\Core\Notification\NotificationService;
use Illuminate\Support\Facades\Log;
use Throwable;

class StoreNotificationController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function __invoke(StoreRequest $request)
    {
        try {
            $this->notificationService->create([
                Notification::CONTENT_COLUMN => $request->get('content')
            ]);

            return redirect()
                ->back()
                ->with('success', 'Notification created successfully');
        } catch (Throwable $e) {
            Log::error('failed create new notification', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/admin')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}