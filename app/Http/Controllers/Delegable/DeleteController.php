<?php

namespace App\Http\Controllers\Delegable;

use App\Http\Controllers\BaseController;
use App\Models\Delegable;
use App\Services\Core\Delegable\DelegableService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class DeleteController extends BaseController
{
    private DelegableService $delegableService;

    public function __construct(DelegableService $delegableService)
    {
        $this->delegableService = $delegableService;
    }

    public function __invoke(string $delegableId): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $delegable = $this->delegableService->findById($delegableId);
            if (!$delegable instanceof Delegable) {
                return $this->withError('Delegable not found!');
            }

            $this->delegableService->delete($user, $delegable);

            return $this->withSuccess([
                'message' => 'Delegable deleted successfully!',
            ]);
        } catch (Throwable $e) {
            Log::error('failed to delete delegable', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
