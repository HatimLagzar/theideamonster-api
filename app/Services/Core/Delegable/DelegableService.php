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
        return $this->delegableRepository->findById($id);
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

    public function delete(User $user, Delegable $delegable): bool
    {
        return $this->delegableRepository->delete($user->getId(), $delegable->getId());
    }

    public function update(Delegable $delegable, array $attributes): bool
    {
        return $this->delegableRepository->update($delegable->getId(), $attributes);
    }
}
