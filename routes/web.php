<?php

use App\Http\Controllers\ClockingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
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
});

require __DIR__.'/auth.php';
