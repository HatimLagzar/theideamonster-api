<?php

namespace App\Http\Controllers\Milestone;

use App\Http\Controllers\BaseController;
use App\Services\Core\Milestone\MilestoneService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ListController extends BaseController
{
    private MilestoneService $milestoneService;

    public function __construct(MilestoneService $milestoneService)
    {
        $this->milestoneService = $milestoneService;
    }

    public function __invoke(string $id): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $milestones = $this->milestoneService->getAllByUser($user);

            return $this->withSuccess([
                'message'    => 'Milestones fetched successfully',
                'milestones' => $milestones
            ]);
        } catch (Throwable $e) {
            Log::error('failed to list milestones', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
