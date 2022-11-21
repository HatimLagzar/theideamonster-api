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

    public function update(string $id, array $attributes): bool
    {
        return $this->getQueryBuilder()
                ->where(MeditationTrack::ID_COLUMN, $id)
                ->update($attributes) > 0;
    }

    protected function getModelClass(): string
    {
        return MeditationTrack::class;
    }
}
