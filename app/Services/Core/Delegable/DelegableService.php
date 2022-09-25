<?php

namespace App\Services\Core\Delegable;

use App\Models\Delegable;
use App\Models\User;
use App\Repositories\Delegable\DelegableRepository;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @return Delegable[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->delegableRepository->getAll();
    }

    /**
     * @param User $user
     * @return Delegable[]|Collection
     */
    public function getAllByUser(User $user): Collection
    {
        return $this->delegableRepository->getAllByUser($user->getId());
    }
}
