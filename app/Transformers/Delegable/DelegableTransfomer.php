<?php

namespace App\Transformers\Delegable;

use App\Models\Delegable;
use Illuminate\Database\Eloquent\Collection;

class DelegableTransfomer
{
    public function transform(Delegable $delegable): array
    {
        return [
            'id'         => $delegable->getId(),
            'user_id'    => $delegable->getUserId(),
            'profile_id' => $delegable->getProfileId(),
            'avatar'     => $delegable->getAvatar(),
            'tasks'      => $delegable->delegableTasks()->with('tasks')->get(),
            'profile'    => $delegable->profile()->first(),
            'created_at' => $delegable->getCreatedAt(),
            'updated_at' => $delegable->getUpdatedAt(),
        ];
    }

    /**
     * @param Collection|Delegable[] $delegables
     * @return Collection
     */
    public function transformMany(Collection $delegables): Collection
    {
        return $delegables->transform(function (Delegable $delegable) {
            return $this->transform($delegable);
        });
    }
}