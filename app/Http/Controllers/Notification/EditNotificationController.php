<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Throwable;

class EditNotificationController extends Controller
{
    public function __invoke(Notification $notification)
    {
        try {
            return view('admin.notifications.edit')
                ->with('notification', $notification);
        } catch (Throwable $e) {
            Log::error('failed show edit notification page', [
                'error_message' => $e->getMessage()
            ]);

            return redirect()
                ->to('/admin')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}