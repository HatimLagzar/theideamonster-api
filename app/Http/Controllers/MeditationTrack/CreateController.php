<?php

namespace App\Http\Controllers\MeditationTrack;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateController extends Controller
{
    public function __invoke()
    {
        try {
            return view('admin.meditation.create');
        } catch (Throwable $e) {
            Log::error('failed to show create meditation track page', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
