<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\AbstractEloquentRepository;

class CategoryRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Category
    {
    }

    public function create(array $attributes): Category
    {
    }

    protected function getModelClass(): string
    {
        return Category::class;
    }
}
