<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class GetCreateNotificationPageController extends Controller
{
    public function __invoke()
    {
        try {
            return view('admin.notifications.create');
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