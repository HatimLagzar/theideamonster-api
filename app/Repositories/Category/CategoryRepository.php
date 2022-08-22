<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Category
    {
    }

    public function create(array $attributes): Category
    {
    }

    /**
     * @param string $userId
     * @return Collection|Category[]
     */
    public function getAllByUser(string $userId): Collection
    {
        return $this->getQueryBuilder()
            ->where(Category::USER_ID_COLUMN, $userId)
            ->get();
    }

    protected function getModelClass(): string
    {
        return Category::class;
    }
}
