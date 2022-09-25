<?php

namespace App\Services\Domain\Delegable;

use App\Models\Delegable;
use App\Models\DelegableTask;
use App\Models\User;
use App\Services\Core\Delegable\DelegableService;
use App\Services\Core\DelegableTask\DelegableTaskService;
use App\Services\Core\Profile\ProfileService;

class CreateDelegableService
{
    private DelegableService $delegableService;
    private ProfileService $profileService;
    private DelegableTaskService $delegableTaskService;

    public function __construct(
        DelegableService $delegableService,
        ProfileService $profileService,
        DelegableTaskService $delegableTaskService
    ) {
        $this->delegableService = $delegableService;
        $this->profileService = $profileService;
        $this->delegableTaskService = $delegableTaskService;
    }

    public function create(
        User $user,
        ?string $name,
        ?string $job,
        array $tasks,
        string $avatar
    ): Delegable {
        $profile = $this->profileService->getOrCreate($name ?: '', $job ?: '');

        $delegable = $this->delegableService->create([
            Delegable::USER_ID_COLUMN    => $user->getId(),
            Delegable::PROFILE_ID_COLUMN => $profile->getId(),
            Delegable::AVATAR_COLUMN     => $avatar,
        ]);

        foreach ($tasks as $taskId) {
            $this->delegableTaskService->create([
                DelegableTask::DELEGABLE_ID_COLUMN => $delegable->getId(),
                DelegableTask::TASK_ID_COLUMN      => $taskId,
            ]);
        }

        return $delegable;
    }
}