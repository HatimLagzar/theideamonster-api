<?php

namespace App\Http\Controllers\Milestone;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Milestone\CreateMilestoneRequest;
use App\Models\Milestone;
use App\Services\Core\Milestone\MilestoneService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateController extends BaseController
{
    private MilestoneService $milestoneService;

    public function __construct(MilestoneService $milestoneService)
    {
        $this->milestoneService = $milestoneService;
    }

    public function __invoke(CreateMilestoneRequest $request): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $milestone = $this->milestoneService->create([
                Milestone::USER_ID_COLUMN   => $user->getId(),
                Milestone::BASKET_ID_COLUMN => $request->get('basket_id'),
                Milestone::ENDS_AT_COLUMN   => $request->get('ends_at'),
            ]);

            return $this->withSuccess([
                'message'   => 'Milestone created successfully',
                'milestone' => $milestone
            ]);
        } catch (Throwable $e) {
            Log::error('failed to create milestone', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
