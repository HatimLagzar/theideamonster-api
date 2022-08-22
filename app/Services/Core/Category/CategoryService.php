<?php

namespace App\Services\Core\Category;

use App\Models\Category;
use App\Models\User;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {

        $this->categoryRepository = $categoryRepository;
    }

    public function create(array $attributes): Category
    {
        return $this->categoryRepository->create($attributes);
    }

    /**
     * @param User $user
     * @return Category[]|Collection
     */
    public function getAllByUser(User $user): Collection
    {
        return $this->categoryRepository->getAllByUser($user->getId());
    }

    public function findByUserAndId(User $user, string $categoryId): ?Category
    {
        return $this->categoryRepository->findByUserAndId($user->getId(), $categoryId);
    }

    public function update(Category $category, array $attributes): bool
    {
        return $this->categoryRepository->update($category->getId(), $attributes);
    }

    public function deleteByUserAndId(User $user, string $categoryId): bool
    {
        return $this->categoryRepository->deleteByUserAndId($user->getId(), $categoryId);
    }
}
