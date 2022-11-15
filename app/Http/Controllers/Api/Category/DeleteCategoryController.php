<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Api\BaseController;
use App\Models\Category;
use App\Services\Core\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class DeleteCategoryController extends BaseController
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function __invoke(string $categoryId): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $category = $this->categoryService->findByUserAndId($user, $categoryId);
            if (!$category instanceof Category) {
                return $this->withError('Category does not exist!', Response::HTTP_NOT_FOUND);
            }

            $this->categoryService->deleteByUserAndId($user, $categoryId);

            return $this->withSuccess([
                'message' => 'Category deleted successfully.',
            ]);
        } catch (Throwable $e) {
            Log::error('failed to delete category', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later.');
        }
    }
}
