<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SendPasswordResetLinkController;
use App\Http\Controllers\Category\CreateCategoryController;
use App\Http\Controllers\Category\DeleteCategoryController;
use App\Http\Controllers\Category\GetUserCategoriesController;
use App\Http\Controllers\Category\UpdateCategoryController;
use App\Http\Controllers\Delegable\CreateController as CreateDelegableController;
use App\Http\Controllers\Delegable\DeleteController as DeleteDelegableController;
use App\Http\Controllers\Delegable\ListController as ListDelegablesController;
use App\Http\Controllers\Profile\UpdateController as UpdateProfileController;
use App\Http\Controllers\Subscriptions\ConfirmSubscriptionController;
use App\Http\Controllers\Subscriptions\CreatePaymentIntentController;
use App\Http\Controllers\Task\CreateTaskController;
use App\Http\Controllers\Task\DeleteTaskController;
use App\Http\Controllers\Task\GetCategoryTasksController;
use App\Http\Controllers\Task\ToggleTaskStatusController;
use App\Http\Controllers\Task\UpdateTaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::post('recover-link', SendPasswordResetLinkController::class);
Route::post('reset-password', ResetPasswordController::class);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', LogoutController::class);

    Route::prefix('categories')->group(function () {
        Route::get('/', GetUserCategoriesController::class);
        Route::post('/', CreateCategoryController::class);
        Route::post('{id}', UpdateCategoryController::class);
        Route::delete('{id}', DeleteCategoryController::class);
    });

    Route::prefix('tasks')->group(function () {
        Route::get('{categoryId}', GetCategoryTasksController::class);
        Route::post('{categoryId}', CreateTaskController::class);
        Route::post('{id}/update', UpdateTaskController::class);
        Route::delete('{id}', DeleteTaskController::class);
        Route::patch('{id}/status', ToggleTaskStatusController::class);
    });

    Route::prefix('subscriptions')->group(function () {
        Route::post('intent', CreatePaymentIntentController::class);
        Route::post('confirm/{setupIntentId}', ConfirmSubscriptionController::class);
    });

    Route::prefix('delegables')->group(function () {
        Route::get('/', ListDelegablesController::class);
        Route::post('/', CreateDelegableController::class);
        Route::delete('{id}', DeleteDelegableController::class);
    });

    Route::prefix('profiles')->group(function () {
        Route::post('{id}', UpdateProfileController::class);
    });
});
