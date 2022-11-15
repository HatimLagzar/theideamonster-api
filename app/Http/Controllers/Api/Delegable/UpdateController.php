<?php

namespace App\Http\Controllers\Api\Delegable;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Delegable\UpdateRequest;
use App\Models\Delegable;
use App\Services\Core\Delegable\DelegableService;
use App\Services\Domain\Delegable\CreateDelegableService;
use App\Transformers\Delegable\DelegableTransfomer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UpdateController extends BaseController
{
    private CreateDelegableService $createDelegableService;
    private DelegableTransfomer $delegableTransfomer;
    private DelegableService $delegableService;

    public function __construct(
        CreateDelegableService $createDelegableService,
        DelegableTransfomer $delegableTransfomer,
        DelegableService $delegableService
    ) {
        $this->createDelegableService = $createDelegableService;
        $this->delegableTransfomer = $delegableTransfomer;
        $this->delegableService = $delegableService;
    }

    public function __invoke(UpdateRequest $request, string $id): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $delegable = $this->delegableService->findById($id);
            if (!$delegable instanceof Delegable) {
                return $this->withError('Delegable not found!', Response::HTTP_NOT_FOUND);
            }

            $this->delegableService->update($delegable, [
                Delegable::NAME_COLUMN => $request->get('name')
            ]);

            return $this->withSuccess([
                'message' => 'Delegable updated successfully.',
            ]);
        } catch (Throwable $e) {
            Log::error('failed to update delegable', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
