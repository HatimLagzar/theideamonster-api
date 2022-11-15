<?php

namespace App\Repositories\Notification;

use App\Models\Notification;
use App\Repositories\AbstractEloquentRepository;

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

    protected function getModelClass(): string
    {
        return Notification::class;
    }
}
