<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Core\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UpdateCategoryController extends BaseController
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function __invoke(UpdateCategoryRequest $request, string $categoryId): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $category = $this->categoryService->findByUserAndId($user, $categoryId);
            if (!$category instanceof Category) {
                return $this->withError('Category not found!', Response::HTTP_NOT_FOUND);
            }

            $filename = $category->getLogo();
            if ($request->file('logo')) {
                $file = $request->file('logo');
                $filename = $file->hashName();
                $file->storeAs('public/baskets_logos/', $filename);
            }

            $this->categoryService->update($category, [
                Category::NAME_COLUMN    => $request->get('name'),
                Category::LOGO_COLUMN    => $filename,
                Category::USER_ID_COLUMN => $user->getId(),
            ]);

            $category = $category->refresh();
            $category->logo = $category->getLogoFullPath();

            return $this->withSuccess([
                'message' => 'Category updated successfully.',
                'basket'  => $category
            ]);
        } catch (Throwable $e) {
            Log::error('failed to update category', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later.');
        }
    }
}
