<?php

namespace App\Http\Controllers\MeditationTrack;

use App\Http\Controllers\Controller;
use App\Models\MeditationTrack;
use Illuminate\Support\Facades\Log;
use Throwable;

class EditController extends Controller
{
    public function __invoke(MeditationTrack $track)
    {
        try {
            return view('admin.meditation.edit')
                ->with('track', $track);
        } catch (Throwable $e) {
            Log::error('failed to show edit track page', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
