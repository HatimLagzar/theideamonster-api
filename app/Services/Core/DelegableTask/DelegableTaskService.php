<?php

namespace App\Services\Core\DelegableTask;

use App\Models\DelegableTask;
use App\Repositories\DelegableTask\DelegableTaskRepository;

class DelegableTaskService
{
    private DelegableTaskRepository $delegableTaskRepository;

    public function __construct(DelegableTaskRepository $delegableTaskRepository)
    {
        $this->delegableTaskRepository = $delegableTaskRepository;
    }

    public function findById(string $id): ?DelegableTask
    {
    }

    public function create(array $attributes): DelegableTask
    {
        return $this->delegableTaskRepository->create($attributes);
    }
}
