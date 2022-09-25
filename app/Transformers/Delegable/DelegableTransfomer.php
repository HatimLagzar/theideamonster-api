<?php

namespace App\Transformers\Delegable;

use App\Models\Delegable;

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
}