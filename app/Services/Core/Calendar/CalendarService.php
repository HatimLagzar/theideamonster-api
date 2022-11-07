<?php

namespace App\Services\Core\Calendar;

use App\Models\Calendar;
use App\Models\User;
use App\Repositories\Calendar\CalendarRepository;

class CalendarService
{
    private CalendarRepository $calendarRepository;

    public function __construct(CalendarRepository $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function findById(string $id): ?Calendar
    {
        return $this->calendarRepository->findById($id);
    }

    public function create(array $attributes): Calendar
    {
        return $this->calendarRepository->create($attributes);
    }

    public function findByUserAndId(User $user, string $id): ?Calendar
    {
        return $this->calendarRepository->findByUserAndId($user->getId(), $id);
    }

    public function update(Calendar $calendar, array $attributes): bool
    {
        return $this->calendarRepository->update($calendar->getId(), $attributes);
    }
}
