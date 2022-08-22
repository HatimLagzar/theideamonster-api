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
        return $this->getQueryBuilder()
            ->create($attributes);
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

    public function findByUserAndId(string $userId, string $categoryId): ?Category
    {
        return $this->getQueryBuilder()
            ->where(Category::USER_ID_COLUMN, $userId)
            ->where(Category::ID_COLUMN, $categoryId)
            ->first();
    }

    public function update(string $categoryId, array $attributes): bool
    {
        return $this->getQueryBuilder()
                ->where(Category::ID_COLUMN, $categoryId)
                ->update($attributes) > 0;
    }

    protected function getModelClass(): string
    {
        return Category::class;
    }
}
