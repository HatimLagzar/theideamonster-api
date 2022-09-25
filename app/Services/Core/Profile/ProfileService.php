<?php

namespace App\Services\Core\Profile;

use App\Models\Profile;
use App\Repositories\Profile\ProfileRepository;

class ProfileService
{
    private ProfileRepository $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function findById(string $id): ?Profile
    {
    }

    public function create(array $attributes): Profile
    {
    }

    public function getOrCreate(string $name, string $job): Profile
    {
        return $this->profileRepository->getOrCreate($name, $job);
    }
}
