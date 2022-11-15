<?php

namespace App\Http\Controllers\Api\Milestone;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Milestone\UpdateRequest;
use App\Models\Milestone;
use App\Services\Core\Milestone\MilestoneService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UpdateController extends BaseController
{
    private MilestoneService $milestoneService;

    public function __construct(MilestoneService $milestoneService)
    {
        $this->milestoneService = $milestoneService;
    }

    public function __invoke(UpdateRequest $request, string $id): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $milestone = $this->milestoneService->findById($user, $id);
            if (!$milestone instanceof Milestone) {
                return $this->withError('Milestone not found!', Response::HTTP_NOT_FOUND);
            }

            $this->milestoneService->update($milestone, [
                Milestone::BASKET_ID_COLUMN  => $request->get('basket_id'),
                Milestone::ENDS_AT_COLUMN    => $request->get('ends_at'),
                Milestone::IS_DONE_COLUMN    => $request->get('is_done'),
                Milestone::PERCENTAGE_COLUMN => $request->get('percentage'),
            ]);

            return $this->withSuccess([
                'message' => 'Milestone update successfully',
            ]);
        } catch (Throwable $e) {
            Log::error('failed to update milestone', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
