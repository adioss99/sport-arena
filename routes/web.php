<?php

use App\Http\Controllers\AdminFieldController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardSuperController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/s{location?}', 'page')->name('home');
    Route::get('/', 'page')->name('home');
    Route::get('/arena', 'arena')->name('arena');
    Route::get('/arena/{slug}', 'detail')->name('arena.detail');
});

Route::middleware(['isLogin'])->group(function () {
    Route::get('/login', [LoginController::class, 'page'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/register', [RegisterController::class, 'page']);
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/booking/store', [BookingController::class, 'booking'])->name('booking.store');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('super')->middleware(['auth:superadmin'])->name('super.')->group(function () {
    Route::controller(DashboardSuperController::class)->group(function () {
        Route::get('/dashboard', 'page')->name('dashboard');
    });
});

Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {
    Route::controller(DashboardAdminController::class)->group(function () {
        Route::get('/dashboard', 'page')->name('dashboard');
    });
    Route::controller(AdminFieldController::class)->group(function () {
        Route::get('/field', 'page')->name('field');
        Route::get('/schedule', 'schedule')->name('schedule');
    });
});

Route::prefix('')->middleware(['auth:user'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'page')->name('dashboard');
    });
});
