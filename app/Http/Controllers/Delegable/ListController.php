<?php

namespace App\Http\Controllers\Delegable;

use App\Http\Controllers\BaseController;
use App\Services\Core\Delegable\DelegableService;
use App\Transformers\Delegable\DelegableTransfomer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class ListController extends BaseController
{
    private DelegableService $delegableService;
    private DelegableTransfomer $delegableTransfomer;

    public function __construct(
        DelegableService $delegableService,
        DelegableTransfomer $delegableTransfomer
    ) {
        $this->delegableService = $delegableService;
        $this->delegableTransfomer = $delegableTransfomer;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $delegables = $this->delegableService->getAllByUser($user);

            return $this->withSuccess([
                'message'    => 'Delegables retrieved successfully.',
                'delegables' => $this->delegableTransfomer->transformMany($delegables)
            ]);
        } catch (Throwable $e) {
            Log::error('failed to list delegables', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
