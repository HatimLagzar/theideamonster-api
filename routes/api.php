<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Category\CreateCategoryController;
use App\Http\Controllers\Category\DeleteCategoryController;
use App\Http\Controllers\Category\GetUserCategoriesController;
use App\Http\Controllers\Category\UpdateCategoryController;
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

Route::middleware('auth:api')->group(function () {
    Route::post('logout', LogoutController::class);

    Route::prefix('categories')->group(function () {
        Route::get('/', GetUserCategoriesController::class);
        Route::post('/', CreateCategoryController::class);
        Route::post('{id}', UpdateCategoryController::class);
        Route::delete('{id}', DeleteCategoryController::class);
    });
});
