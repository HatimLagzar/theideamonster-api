<?php

namespace App\Repositories\MeditationTrack;

use App\Models\MeditationTrack;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class MeditationTrackRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?MeditationTrack
    {
    }

    public function create(array $attributes): MeditationTrack
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    /**
     * @return MeditationTrack[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->getQueryBuilder()
            ->get();
    }

    protected function getModelClass(): string
    {
        return MeditationTrack::class;
    }
}
