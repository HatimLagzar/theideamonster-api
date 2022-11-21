<?php

namespace App\Http\Controllers\MeditationTrack;

use App\Http\Controllers\Controller;
use App\Models\MeditationTrack;
use Illuminate\Support\Facades\Log;
use Throwable;

class DeleteController extends Controller
{
    public function __invoke(MeditationTrack $track)
    {
        try {
            $track->delete();

            return redirect()
                ->back()
                ->with('success', 'Meditation track deleted successfully.');
        } catch (Throwable $e) {
            Log::error('failed to delete track', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
