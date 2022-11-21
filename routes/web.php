<?php

use App\Http\Controllers\MeditationTrack\CreateController as CreateMeditationController;
use App\Http\Controllers\MeditationTrack\EditController as EditMeditationController;
use App\Http\Controllers\MeditationTrack\IndexController as IndexMeditationController;
use App\Http\Controllers\MeditationTrack\StoreController as StoreMeditationController;
use App\Http\Controllers\MeditationTrack\UpdateController as UpdateMeditationController;
use App\Http\Controllers\Notification\DeleteNotificationController;
use App\Http\Controllers\Notification\EditNotificationController;
use App\Http\Controllers\Notification\GetCreateNotificationPageController;
use App\Http\Controllers\Notification\ListNotificationsController;
use App\Http\Controllers\Notification\PushNotificationController;
use App\Http\Controllers\Notification\StoreNotificationController;
use App\Http\Controllers\Notification\UpdateNotificationController;
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
            Route::get('/', ListNotificationsController::class)->name('index');
            Route::get('create', GetCreateNotificationPageController::class)->name('create');
            Route::get('{notification}', EditNotificationController::class)->name('edit');
            Route::post('{notification}', UpdateNotificationController::class)->name('update');
            Route::post('{notification}', PushNotificationController::class)->name('push');
            Route::delete('{notification}', DeleteNotificationController::class)->name('delete');
            Route::post('/', StoreNotificationController::class)->name('store');
        });

        Route::prefix('meditation')->name('meditation.')->group(function () {
            Route::get('/', IndexMeditationController::class)->name('index');
            Route::get('create', CreateMeditationController::class)->name('create');
            Route::post('/', StoreMeditationController::class)->name('store');
            Route::get('{track}/edit', EditMeditationController::class)->name('edit');
            Route::post('{track}', UpdateMeditationController::class)->name('update');
        });
    });
});
