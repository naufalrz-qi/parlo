<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\FacilityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookingController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DestinationsController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/destinations', [DestinationsController::class, 'showDestinations'])->name('destinations.universal');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/error', function () {
        return view('error');
    })->name('error');
});


Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:employee'])->group(function () {
        Route::get('/dashboard/employee', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
    });

    Route::middleware(['role:admin'])->group(function () {

        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');


        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('users', UserController::class);

        Route::prefix('admin')->group(function () {
            Route::get('destinations/view', [DestinationsController::class, 'view'])->name('view.destinations');
            Route::get('destinations/add', [DestinationsController::class, 'add'])->name('add.destinations');
            Route::post('destinations/store', [DestinationsController::class, 'store'])->name('store.destinations');
            Route::get('destinations/{destination}/edit', [DestinationsController::class, 'edit'])->name('edit.destinations');
            Route::put('destinations/{destination}/update', [DestinationsController::class, 'update'])->name('update.destinations');
            Route::get('destinations/{destination}/show', [DestinationsController::class, 'show'])->name('show.destinations');
            Route::delete('destinations/{destination}/destroy', [DestinationsController::class, 'destroy'])->name('destroy.destinations');
        });
    });
});

Route::middleware(['admin_or_employee'])->group(function () {
    Route::resource('facilities', FacilityController::class);
});

// Booking Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.page');


    Route::get('/bookings/create/{destination}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});



// Route::middleware(['auth', 'role:employee'])->group(function () {
//     Route::get('/dashboard/employee', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
//     Route::resource('facilities', FacilityController::class);
// });

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::controller(AdminController::class)->group(function () {
//         Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
//     });
//     Route::controller(DestinationsController::class)->group(function () {
//         Route::get('/admin/destinations/view', 'view')->name('view.destinations');
//         Route::get('/admin/destinations/add', 'add')->name('add.destinations');
//         Route::post('/admin/destinations/store', 'store')->name('store.destinations');
//         Route::get('/admin/destinations/{destination}/edit', 'edit')->name('edit.destinations');
//         Route::put('/admin/destinations/{destination}/update', 'update')->name('update.destinations');
//         Route::get('/admin/destinations/{destination}/show', 'show')->name('show.destinations');
//         Route::delete('/admin/destinations/{destination}/destroy', 'destroy')->name('destroy.destinations');
//     });


//     Route::resource('facilities', FacilityController::class);
//     Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
//     Route::resource('users', UserController::class);
// });

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
