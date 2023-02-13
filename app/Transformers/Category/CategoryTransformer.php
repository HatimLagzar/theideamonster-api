<?php

namespace App\Transformers\Category;

use App\Models\Category;
use App\Transformers\Task\TaskTransformer;
use Illuminate\Database\Eloquent\Collection;

class CategoryTransformer
{
    private TaskTransformer $taskTransformer;

    public function __construct(TaskTransformer $taskTransformer)
    {
        $this->taskTransformer = $taskTransformer;
    }

    public function transform(Category $category): array
    {
        return [
            'id'         => $category->getId(),
            'name'       => $category->getName(),
            'logo'       => $category->getLogoFullPath(),
            'user_id'    => $category->getUserId(),
            'tasks'      => $this->taskTransformer->transformMany($category->tasks()->get()),
            'created_at' => $category->getCreatedAt(),
        ];
    }

    /**
     * @param Collection|Category[] $categories
     * @return Collection
     */
    public function transformMany(Collection $categories): Collection
    {
        return $categories->transform(function (Category $category) {
            return $this->transform($category);
        });
    }
}