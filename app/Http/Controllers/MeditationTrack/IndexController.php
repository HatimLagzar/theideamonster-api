<?php

namespace App\Http\Controllers\MeditationTrack;

use App\Http\Controllers\Controller;
use App\Services\Core\MeditationTrack\MeditationTrackService;
use Illuminate\Support\Facades\Log;
use Throwable;

class IndexController extends Controller
{
    private MeditationTrackService $meditationTrackService;

    public function __construct(MeditationTrackService $meditationTrackService)
    {
        $this->meditationTrackService = $meditationTrackService;
    }

    public function __invoke()
    {
        try {
            $tracks = $this->meditationTrackService->getAll();

            return view('admin.meditation.index')
                ->with('tracks', $tracks);
        } catch (Throwable $e) {
            Log::error('failed to list meditation tracks', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
