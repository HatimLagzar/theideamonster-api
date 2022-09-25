<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Profile;
use App\Services\Core\Profile\Exceptions\ProfileNotFoundException;
use App\Services\Core\Profile\ProfileService;
use App\Services\Domain\Profile\UpdateProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UpdateController extends BaseController
{
    private ProfileService $profileService;
    private UpdateProfileService $updateProfileService;

    public function __construct(
        ProfileService $profileService,
        UpdateProfileService $updateProfileService
    ) {
        $this->profileService = $profileService;
        $this->updateProfileService = $updateProfileService;
    }

    public function __invoke(UpdateRequest $request, string $profileId): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $profile = $this->updateProfileService->update($user, $profileId, [
                Profile::NAME_COLUMN => $request->get('name'),
                Profile::JOB_COLUMN  => $request->get('job'),
            ]);

            return $this->withSuccess([
                'message' => 'Profile updated successfully!',
                'profile' => $profile
            ]);
        } catch (ProfileNotFoundException $e) {
            return $this->withError('Profile not found!', Response::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            Log::error('failed to update profile', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
