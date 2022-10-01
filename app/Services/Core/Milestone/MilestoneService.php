<?php

namespace App\Services\Core\Milestone;

use App\Models\Milestone;
use App\Models\User;
use App\Repositories\Milestone\MilestoneRepository;

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
}
