<?php

namespace App\Transformers\Milestone;

use App\Models\Milestone;
use Illuminate\Database\Eloquent\Collection;

class MilestoneTransformer
{
    public function transform(Milestone $milestone): array
    {
        return [
            'id'         => $milestone->getId(),
            'user_id'    => $milestone->getUserId(),
            'basket_id'  => $milestone->getBasketId(),
            'ends_at'    => $milestone->getEndsAt()->format('Y-m-d'),
            'is_done'    => $milestone->isDone(),
            'percentage' => $milestone->getPercentage(),
            'difference' => $milestone->getEndsAt()->diff(now())->invert === 0
                ? -1 * $milestone->getEndsAt()->diff(now())->days
                : $milestone->getEndsAt()->diff(now())->days,
            'basket'     => $milestone->basket()->first(),
            'created_at' => $milestone->getCreatedAt(),
            'updated_at' => $milestone->getUpdatedAt(),
        ];
    }

    /**
     * @param Collection|Milestone[] $milestones
     * @return Collection
     */
    public function transformMany(Collection $milestones): Collection
    {
        return $milestones->transform(function (Milestone $milestone) {
            return $this->transform($milestone);
        });
    }
}
