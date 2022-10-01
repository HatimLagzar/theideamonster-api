<?php

namespace App\Http\Controllers\Milestone;

use App\Http\Controllers\BaseController;
use App\Models\Milestone;
use App\Services\Core\Milestone\MilestoneService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class DeleteController extends BaseController
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

            $milestone = $this->milestoneService->findById($user, $id);
            if (!$milestone instanceof Milestone) {
                return $this->withError('Milestone not found!', Response::HTTP_NOT_FOUND);
            }

            $this->milestoneService->delete($milestone);

            return $this->withSuccess([
                'message' => 'Milestone deleted successfully',
            ]);
        } catch (Throwable $e) {
            Log::error('failed to delete milestone', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
