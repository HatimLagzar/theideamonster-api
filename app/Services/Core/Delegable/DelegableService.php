<?php

namespace App\Services\Core\Delegable;

use App\Models\Delegable;
use App\Repositories\Delegable\DelegableRepository;

class DelegableService
{
    private DelegableRepository $delegableRepository;

    public function __construct(DelegableRepository $delegableRepository)
    {
        $this->delegableRepository = $delegableRepository;
    }

    public function findById(string $id): ?Delegable
    {
    }

    public function create(array $attributes): Delegable
    {
        return $this->delegableRepository->create($attributes);
    }
}
