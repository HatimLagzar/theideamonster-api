<?php

namespace App\Http\Controllers\Api\Delegable;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Delegable\CreateRequest;
use App\Services\Domain\Delegable\CreateDelegableService;
use App\Transformers\Delegable\DelegableTransfomer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateController extends BaseController
{
    private CreateDelegableService $createDelegableService;
    private DelegableTransfomer $delegableTransfomer;

    public function __construct(
        CreateDelegableService $createDelegableService,
        DelegableTransfomer $delegableTransfomer
    ) {
        $this->createDelegableService = $createDelegableService;
        $this->delegableTransfomer = $delegableTransfomer;
    }

    public function __invoke(CreateRequest $request): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $delegable = $this->createDelegableService->create(
                $user,
                $request->get('name'),
                $request->get('job'),
                $request->get('tasks'),
                $request->get('avatar'),
            );

            return $this->withSuccess([
                'message'   => 'Delegable created successfully.',
                'delegable' => $this->delegableTransfomer->transform($delegable),
            ]);
        } catch (Throwable $e) {
            Log::error('failed to create delegable', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
