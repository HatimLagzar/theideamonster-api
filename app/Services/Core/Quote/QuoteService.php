<?php

namespace App\Services\Core\Quote;

use App\Models\Quote;
use App\Repositories\Quote\QuoteRepository;

class QuoteService
{
    private QuoteRepository $quoteRepository;

    public function __construct(QuoteRepository $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    public function getRandomOne(): ?Quote
    {
        return $this->quoteRepository->getRandomOne();
    }
}
