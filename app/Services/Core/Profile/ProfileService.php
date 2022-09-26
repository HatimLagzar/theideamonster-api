<?php

namespace App\Services\Core\Profile;

use App\Models\Profile;
use App\Models\User;
use App\Repositories\Profile\ProfileRepository;

class ProfileService
{
    private ProfileRepository $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function findById(User $user, string $id): ?Profile
    {
        return $this->profileRepository->findById($user->getId(), $id);
    }

    public function getOrCreate(string $job, string $userId): Profile
    {
        return $this->profileRepository->getOrCreate($job, $userId);
    }

    public function update(Profile $profile, array $attributes): bool
    {
        return $this->profileRepository->update($profile->getId(), $attributes);
    }
}
