<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BookingController;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect('/login');

});

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        return view('dashboard');

    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | BOOKING
    |--------------------------------------------------------------------------
    */

    Route::get('/booking', [BookingController::class, 'create'])
        ->name('booking.create');

    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');

    Route::get('/my-bookings', [BookingController::class, 'history'])
        ->name('booking.history');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

   Route::get('/admin/dashboard', function () {

    $totalBookings = Booking::count();

    $totalServices = Service::count();

    $totalUsers = User::count();

    $pendingBookings = Booking::where('status', 'pending')->count();

    return view('admin.dashboard', compact(
        'totalBookings',
        'totalServices',
        'totalUsers',
        'pendingBookings'
    ));

})->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | SERVICES CRUD
    |--------------------------------------------------------------------------
    */

    Route::resource('/admin/services', ServiceController::class);

    /*
    |--------------------------------------------------------------------------
    | BOOKING LIST
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/bookings', [BookingController::class, 'index'])
        ->name('admin.bookings');

    Route::put('/admin/bookings/{booking}/approve',
        [BookingController::class, 'approve']);

    Route::put('/admin/bookings/{booking}/complete',
        [BookingController::class, 'complete']);

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
