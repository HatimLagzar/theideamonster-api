<?php

namespace App\Services\Core\Notification;

use App\Models\Notification;
use App\Repositories\Notification\NotificationRepository;

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
}
