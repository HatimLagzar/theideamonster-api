<?php

use App\Http\Controllers\Notification\GetCreateNotificationPageController;
use App\Http\Controllers\Notification\StoreNotificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('verification.verify');

Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Auth::routes(['register' => env('ALLOW_ADMIN_REGISTER', false)]);

    Route::middleware('auth:web')->group(function () {
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('create', GetCreateNotificationPageController::class)->name('create');
            Route::post('/', StoreNotificationController::class)->name('store');
        });
    });
});
