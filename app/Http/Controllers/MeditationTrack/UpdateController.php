<?php

namespace App\Http\Controllers\MeditationTrack;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeditationTrack\UpdateRequest;
use App\Models\MeditationTrack;
use App\Services\Core\MeditationTrack\MeditationTrackService;
use Illuminate\Support\Facades\Log;
use Throwable;

class UpdateController extends Controller
{
    private MeditationTrackService $meditationTrackService;

    public function __construct(MeditationTrackService $meditationTrackService)
    {
        $this->meditationTrackService = $meditationTrackService;
    }

    public function __invoke(UpdateRequest $request, MeditationTrack $track)
    {
        try {
            $fileName = $track->getTrackFileName();
            if ($request->hasFile('track')) {
                $file = $request->file('track');
                $fileName = $file->hashName();
                $file->storeAs('public/meditation/', $fileName);
            }

            $this->meditationTrackService->update($track, [
                MeditationTrack::NAME_COLUMN => $request->get('name'),
                MeditationTrack::DURATION_COLUMN => $request->get('duration'),
                MeditationTrack::TRACK_FILENAME_COLUMN => $fileName,
            ]);

            return redirect()
                ->route('meditation.index')
                ->with('success', 'Meditation track updated successfully.');
        } catch (Throwable $e) {
            Log::error('failed to update track', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('home')
                ->with('error', 'Error occurred, please retry later!');
        }
    }
}
