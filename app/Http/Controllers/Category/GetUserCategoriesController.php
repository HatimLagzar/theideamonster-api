<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\BaseController;
use App\Services\Core\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class GetUserCategoriesController extends BaseController
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $categories = $this->categoryService->getAllByUser($user);

            return $this->withSuccess([
                'message' => 'Categories fetched successfully.',
                'categories' => $categories
            ]);
        } catch (Throwable $e) {
            Log::error('failed to fetch categories', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later.');
        }
    }
}