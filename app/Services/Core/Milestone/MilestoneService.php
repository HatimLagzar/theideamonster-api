<?php

namespace App\Services\Core\Milestone;

use App\Models\Milestone;
use App\Models\User;
use App\Repositories\Milestone\MilestoneRepository;
use Illuminate\Database\Eloquent\Collection;

class MilestoneService
{
    private MilestoneRepository $milestoneRepository;

    public function __construct(MilestoneRepository $milestoneRepository)
    {
        $this->milestoneRepository = $milestoneRepository;
    }

    public function findById(User $user, string $id): ?Milestone
    {
        return $this->milestoneRepository->findById($user->getId(), $id);
    }

    public function create(array $attributes): Milestone
    {
        return $this->milestoneRepository->create($attributes);
    }

    public function delete(Milestone $milestone): bool
    {
        return $this->milestoneRepository->delete($milestone->getId());
    }

    /**
     * @param User $user
     * @return Milestone[]|Collection
     */
    public function getAllByUser(User $user): Collection
    {
        return $this->milestoneRepository->getAllByUser($user->getId());
    }

    public function update(Milestone $milestone, array $attributes): bool
    {
        return $this->milestoneRepository->update($milestone->getId(), $attributes);
    }
}
