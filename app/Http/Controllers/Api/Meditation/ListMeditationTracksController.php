<?php

namespace App\Http\Controllers\Api\Meditation;

use App\Http\Controllers\Api\BaseController;
use App\Services\Core\MeditationTrack\MeditationTrackService;
use App\Transformers\Meditation\MeditationTrackTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ListMeditationTracksController extends BaseController
{
    private MeditationTrackService $meditationTrackService;
    private MeditationTrackTransformer $meditationTrackTransformer;

    public function __construct(
        MeditationTrackService $meditationTrackService,
        MeditationTrackTransformer $meditationTrackTransformer
    ) {
        $this->meditationTrackService = $meditationTrackService;
        $this->meditationTrackTransformer = $meditationTrackTransformer;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $tracks = $this->meditationTrackService->getAll();

            return $this->withSuccess([
                'message' => 'Meditation tracks fetched successfully.',
                'tracks'  => $this->meditationTrackTransformer->transformMany($tracks)
            ]);
        } catch (Throwable $e) {
            Log::error('failed to list meditation tracks', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}