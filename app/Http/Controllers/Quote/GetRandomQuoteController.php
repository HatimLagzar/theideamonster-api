<?php

namespace App\Http\Controllers\Quote;

use App\Http\Controllers\BaseController;
use App\Services\Core\Quote\QuoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class GetRandomQuoteController extends BaseController
{
    private QuoteService $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $quote = $this->quoteService->getRandomOne();

            return $this->withSuccess([
                'quote' => $quote
            ]);
        } catch (Throwable $e) {
            Log::error('failed to get random quote', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
