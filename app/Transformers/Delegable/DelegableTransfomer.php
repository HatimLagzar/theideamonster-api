<?php

namespace App\Transformers\Delegable;

use App\Models\Delegable;
use App\Models\DelegableTask;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class DelegableTransfomer
{
    public function transform(Delegable $delegable): array
    {
        return [
            'id'         => $delegable->getId(),
            'name'       => $delegable->getName(),
            'user_id'    => $delegable->getUserId(),
            'profile_id' => $delegable->getProfileId(),
            'avatar'     => $delegable->getAvatar(),
            'tasks'      => Arr::flatten($delegable->delegableTasks()->get()
                ->transform(function (DelegableTask $delegableTask) {
                    return $delegableTask->task()->get();
                })),
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