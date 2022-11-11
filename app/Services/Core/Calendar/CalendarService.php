<?php

namespace App\Services\Core\Calendar;

use App\Models\Calendar;
use App\Models\User;
use App\Repositories\Calendar\CalendarRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

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

    public function delete(User $user, string $id): bool
    {
        return $this->calendarRepository->delete($user->getId(), $id);
    }

    /**
     * @param User $user
     * @return Calendar[]|Collection
     */
    public function getByUser(User $user): Collection
    {
        return $this->calendarRepository->getByUser($user->getId());
    }

    /**
     * @param User $user
     * @param Carbon $date
     * @return Calendar[]|Collection
     */
    public function getByUserAndDate(User $user, Carbon $date): Collection
    {
        return $this->calendarRepository->getByUserAndDate($user->getId(), $date);
    }

    /**
     * @param User $user
     * @return Calendar[]|Collection
     */
    public function getByUserAndUncategorized(User $user): Collection
    {
        return $this->calendarRepository->getByUserAndUncategorized($user->getId());
    }
}
