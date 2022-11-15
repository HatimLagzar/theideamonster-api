<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Category;
use App\Services\Core\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateCategoryController extends BaseController
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function __invoke(CreateCategoryRequest $request): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $category = $this->categoryService->create([
                Category::NAME_COLUMN => $request->get('name'),
                Category::USER_ID_COLUMN => $user->getId(),
            ]);

            return $this->withSuccess([
                'message' => 'Category created successfully.',
                'category' => $category
            ]);
        } catch (Throwable $e) {
            Log::error('failed to create category', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later.');
        }
    }
}
