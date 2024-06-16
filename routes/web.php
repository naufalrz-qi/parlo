<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\FacilityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DestinationsController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/destinations', [DestinationsController::class, 'showDestinations'])->name('destinations.universal');


Route::middleware(['auth', 'verified'])->group(function () {
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    });
    Route::controller(DestinationsController::class)->group(function () {
        Route::get('/admin/destinations/view', 'view')->name('view.destinations');
        Route::get('/admin/destinations/add', 'add')->name('add.destinations');
        Route::post('/admin/destinations/store', 'store')->name('store.destinations');
        Route::get('/admin/destinations/{destination}/edit', 'edit')->name('edit.destinations');
        Route::put('/admin/destinations/{destination}/update', 'update')->name('update.destinations');
        Route::get('/admin/destinations/{destination}/show', 'show')->name('show.destinations');
        Route::delete('/admin/destinations/{destination}/destroy', 'destroy')->name('destroy.destinations');
    });


    Route::resource('facilities', FacilityController::class);
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(HomeUserController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
