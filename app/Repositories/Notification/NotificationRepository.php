<?php

namespace App\Repositories\Notification;

use App\Models\Notification;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class NotificationRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Notification
    {
    }

    public function create(array $attributes): Notification
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    /**
     * @return Notification[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->getQueryBuilder()
            ->get();
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->getQueryBuilder()
                ->where(Notification::ID_COLUMN, $id)
                ->update($attributes) > 0;
    }

    protected function getModelClass(): string
    {
        return Notification::class;
    }
}
