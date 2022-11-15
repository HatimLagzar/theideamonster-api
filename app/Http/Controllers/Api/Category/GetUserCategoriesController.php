<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Api\BaseController;
use App\Services\Core\Category\CategoryService;
use App\Transformers\Category\CategoryTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class GetUserCategoriesController extends BaseController
{
    private CategoryService $categoryService;
    private CategoryTransformer $categoryTransformer;

    public function __construct(CategoryService $categoryService, CategoryTransformer $categoryTransformer)
    {
        $this->categoryService = $categoryService;
        $this->categoryTransformer = $categoryTransformer;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $categories = $this->categoryService->getAllByUser($user);

            return $this->withSuccess([
                'message'    => 'Categories fetched successfully.',
                'categories' => $this->categoryTransformer->transformMany($categories)
            ]);
        } catch (Throwable $e) {
            Log::error('failed to fetch categories', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later.');
        }
    }
}