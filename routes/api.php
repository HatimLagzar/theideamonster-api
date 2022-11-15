<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\SendPasswordResetLinkController;
use App\Http\Controllers\Api\Calendar\DeleteController as DeleteFromCalendarController;
use App\Http\Controllers\Api\Calendar\GetItemFromCalendarController;
use App\Http\Controllers\Api\Calendar\GetItemsByDateController;
use App\Http\Controllers\Api\Calendar\ListController as ListCalendarController;
use App\Http\Controllers\Api\Calendar\StoreController as StoreInCalendarController;
use App\Http\Controllers\Api\Calendar\UpdateController as UpdateInCalendarController;
use App\Http\Controllers\Api\Category\CreateCategoryController;
use App\Http\Controllers\Api\Category\DeleteCategoryController;
use App\Http\Controllers\Api\Category\GetUserCategoriesController;
use App\Http\Controllers\Api\Category\UpdateCategoryController;
use App\Http\Controllers\Api\Delegable\CreateController as CreateDelegableController;
use App\Http\Controllers\Api\Delegable\DeleteController as DeleteDelegableController;
use App\Http\Controllers\Api\Delegable\ListController as ListDelegablesController;
use App\Http\Controllers\Api\Delegable\UpdateController as UpdateDelegableController;
use App\Http\Controllers\Api\Milestone\CreateController as CreateMilestoneController;
use App\Http\Controllers\Api\Milestone\DeleteController as DeleteMilestoneController;
use App\Http\Controllers\Api\Milestone\ListController as ListMilestonesController;
use App\Http\Controllers\Api\Milestone\UpdateController as UpdateMilestoneController;
use App\Http\Controllers\Api\Profile\UpdateController as UpdateProfileController;
use App\Http\Controllers\Api\Quote\GetRandomQuoteController;
use App\Http\Controllers\Api\Subscriptions\ConfirmSubscriptionController;
use App\Http\Controllers\Api\Subscriptions\CreatePaymentIntentController;
use App\Http\Controllers\Api\Task\CreateTaskController;
use App\Http\Controllers\Api\Task\DeleteTaskController;
use App\Http\Controllers\Api\Task\GetCategoryTasksController;
use App\Http\Controllers\Api\Task\ToggleTaskStatusController;
use App\Http\Controllers\Api\Task\UpdateTaskController;
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

    Route::prefix('quotes')->group(function () {
        Route::get('/', GetRandomQuoteController::class);
    });

    Route::middleware('is-subscribed')->group(function () {
        Route::prefix('delegables')->group(function () {
            Route::get('/', ListDelegablesController::class);
            Route::post('/', CreateDelegableController::class);
            Route::post('{id}', UpdateDelegableController::class);
            Route::delete('{id}', DeleteDelegableController::class);
        });

        Route::prefix('milestones')->group(function () {
            Route::get('/', ListMilestonesController::class);
            Route::post('/', CreateMilestoneController::class);
            Route::post('{id}', UpdateMilestoneController::class);
            Route::delete('{id}', DeleteMilestoneController::class);
        });

        Route::prefix('profiles')->group(function () {
            Route::post('{id}', UpdateProfileController::class);
        });

        Route::prefix('calendar')->group(function () {
            Route::get('/', ListCalendarController::class);
            Route::get('filter/{date}', GetItemsByDateController::class);
            Route::get('{id}', GetItemFromCalendarController::class);
            Route::post('/', StoreInCalendarController::class);
            Route::post('{id}', UpdateInCalendarController::class);
            Route::delete('{id}', DeleteFromCalendarController::class);
        });
    });
});
