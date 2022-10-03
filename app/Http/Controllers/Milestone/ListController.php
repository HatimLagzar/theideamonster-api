<?php

namespace App\Http\Controllers\Milestone;

use App\Http\Controllers\BaseController;
use App\Services\Core\Milestone\MilestoneService;
use App\Transformers\Milestone\MilestoneTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ListController extends BaseController
{
    private MilestoneService $milestoneService;
    private MilestoneTransformer $milestoneTransformer;

    public function __construct(
        MilestoneService $milestoneService,
        MilestoneTransformer $milestoneTransformer
    ) {
        $this->milestoneService = $milestoneService;
        $this->milestoneTransformer = $milestoneTransformer;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $milestones = $this->milestoneService->getAllByUser($user);

            return $this->withSuccess([
                'message'    => 'Milestones fetched successfully',
                'milestones' => $this->milestoneTransformer->transformMany($milestones)
            ]);
        } catch (Throwable $e) {
            Log::error('failed to list milestones', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
