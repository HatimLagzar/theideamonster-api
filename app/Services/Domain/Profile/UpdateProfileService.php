<?php

namespace App\Services\Domain\Profile;

use App\Models\Profile;
use App\Models\User;
use App\Services\Core\Profile\Exceptions\ProfileNotFoundException;
use App\Services\Core\Profile\ProfileService;

class UpdateProfileService
{
    private ProfileService $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * @throws ProfileNotFoundException
     */
    public function update(User $user, string $id, array $attributes): Profile
    {
        $profile = $this->profileService->findById($user, $id);
        if (!$profile instanceof Profile) {
            throw new ProfileNotFoundException();
        }

        $this->profileService->update($profile, $attributes);

        return $this->profileService->findById($user, $id);
    }
}