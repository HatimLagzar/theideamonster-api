<?php

namespace App\Transformers\Meditation;

use App\Models\MeditationTrack;
use Illuminate\Database\Eloquent\Collection;

class MeditationTrackTransformer
{
    public function transformMany(Collection $tracks): Collection
    {
        return $tracks->transform(fn(MeditationTrack $track) => $this->transform($track));
    }

    public function transform(MeditationTrack $meditationTrack): array
    {
        return [
            'id'         => $meditationTrack->getId(),
            'name'       => $meditationTrack->getName(),
            'duration'   => $meditationTrack->getDuration(),
            'url'        => url('storage/meditation/' . $meditationTrack->getTrackFileName()),
            'created_at' => $meditationTrack->getCreatedAt(),
        ];
    }
}