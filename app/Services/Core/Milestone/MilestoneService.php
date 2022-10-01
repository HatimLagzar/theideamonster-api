<?php

namespace App\Services\Core\Milestone;

use App\Models\Milestone;
use App\Repositories\Milestone\MilestoneRepository;

class MilestoneService
{
    private MilestoneRepository $milestoneRepository;

    public function __construct(MilestoneRepository $milestoneRepository)
    {
        $this->milestoneRepository = $milestoneRepository;
    }

    public function findById(string $id): ?Milestone
    {
    }

    public function create(array $attributes): Milestone
    {
        return $this->milestoneRepository->create($attributes);
    }
}
