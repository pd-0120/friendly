<?php

use App\Http\Controllers\ClockingController;
use App\Http\Controllers\Dashboard\ChartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPayController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Artisan::call('pay:generate');
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User routes
    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/',[UserController::class, 'index'])->name('index');
        Route::get('create',[UserController::class, 'create'])->name('create');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::delete('{user}/destroy', [UserController::class, 'destroy'])->name('delete');
    });

    // Store routes
    Route::prefix('stores')->name('store.')->group(function () {
        Route::get('/', [StoreController::class, 'index'])->name('index');
        Route::get('create', [StoreController::class, 'create'])->name('create');
        Route::get('{store}/edit', [StoreController::class, 'edit'])->name('edit');
        Route::delete('{store}/destroy', [StoreController::class, 'destroy'])->name('delete');
    });

    // Clocking routes
    Route::prefix('clockings')->name('clocking.')->group(function () {
        Route::get('/', [ClockingController::class, 'index'])->name('index');
        Route::get('create', [ClockingController::class, 'create'])->name('create');
        Route::get('{clocking}/edit', [ClockingController::class, 'edit'])->name('edit');
        Route::delete('{clocking}/destroy', [ClockingController::class, 'destroy'])->name('delete');
    });

    // Pay routes
    Route::prefix('pays')->name('pay.')->group(function () {
        Route::get('/', [UserPayController::class, 'index'])->name('index');
        Route::get('{pay}/edit', [UserPayController::class, 'edit'])->name('edit');
        Route::delete('{pay}/destroy', [UserPayController::class, 'destroy'])->name('delete');
        Route::post('pay/update/status/{pay}', [UserPayController::class, 'upatePayStatus'])->name('update-pay-status');
    });

    Route::prefix('api/chart')->name('chart.')->group(function () {
        Route::get('/user-pay-bar-chart', [ChartController::class, 'userPayBarChart'])->name('user-pay-bar-chart');
    });
});

require __DIR__.'/auth.php';
