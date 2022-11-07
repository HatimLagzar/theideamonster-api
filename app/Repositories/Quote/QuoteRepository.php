<?php

namespace App\Repositories\Quote;

use App\Models\Quote;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class QuoteRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Quote
    {
    }

    public function create(array $attributes): Quote
    {
    }

    /**
     * @return Quote[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->getQueryBuilder()
            ->get();
    }

    public function getRandomOne(): ?Quote
    {
        return $this->getQueryBuilder()
            ->inRandomOrder()
            ->first();
    }

    protected function getModelClass(): string
    {
        return Quote::class;
    }
}
