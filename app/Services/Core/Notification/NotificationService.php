<?php

namespace App\Services\Core\Notification;

use App\Models\Notification;
use App\Repositories\Notification\NotificationRepository;
use Illuminate\Database\Eloquent\Collection;

class NotificationService
{
    private NotificationRepository $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function findById(string $id): ?Notification
    {
    }

    public function create(array $attributes): Notification
    {
        return $this->notificationRepository->create($attributes);
    }

    /**
     * @return Notification[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->notificationRepository->getAll();
    }

    public function update(Notification $notification, array $attributes): bool
    {
        return $this->notificationRepository->update($notification->getId(), $attributes);
    }

    public function delete(Notification $notification): bool
    {
        return $this->notificationRepository->delete($notification->getId());
    }

    public function increment(Notification $notification, string $column): bool
    {
        return $this->notificationRepository->increment($notification->getId(), $column);
    }
}
