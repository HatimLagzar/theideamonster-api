<?php

namespace App\Services\Core\MeditationTrack;

use App\Models\MeditationTrack;
use App\Repositories\MeditationTrack\MeditationTrackRepository;
use Illuminate\Database\Eloquent\Collection;

class MeditationTrackService
{
    private MeditationTrackRepository $meditationTrackRepository;

    public function __construct(MeditationTrackRepository $meditationTrackRepository)
    {
        $this->meditationTrackRepository = $meditationTrackRepository;
    }

    public function findById(string $id): ?MeditationTrack
    {
    }

    public function create(array $attributes): MeditationTrack
    {
        return $this->meditationTrackRepository->create($attributes);
    }

    /**
     * @return MeditationTrack[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->meditationTrackRepository->getAll();
    }

    public function update(MeditationTrack $track, array $attributes): bool
    {
        return $this->meditationTrackRepository->update($track->getId(), $attributes);
    }
}
