<?php

use Illuminate\Support\Facades\Route;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;

use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BookingController;

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

    Route::get('/booking',
        [BookingController::class, 'create'])
        ->name('booking.create');

    Route::post('/booking',
        [BookingController::class, 'store'])
        ->name('booking.store');

    /*
    |--------------------------------------------------------------------------
    | BOOKING HISTORY
    |--------------------------------------------------------------------------
    */

    Route::get('/my-bookings',
        [BookingController::class, 'history'])
        ->name('booking.history');

});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile',
        function () {

            return view('profile.index');

        })->name('profile');

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

        $pendingBookings = Booking::where(
            'status',
            'pending'
        )->count();

        $completedBookings = Booking::where(
            'status',
            'completed'
        )->count();

        $cancelledBookings = Booking::where(
            'status',
            'cancelled'
        )->count();

        $revenue = Booking::where(
            'status',
            'completed'
        )->count() * 50000;

        return view('admin.dashboard', compact(
            'totalBookings',
            'totalServices',
            'totalUsers',
            'pendingBookings',
            'completedBookings',
            'cancelledBookings',
            'revenue'
        ));

    })->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | SERVICES CRUD
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/services',
        ServiceController::class
    );

    /*
    |--------------------------------------------------------------------------
    | BOOKING MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/bookings',
        [BookingController::class, 'index'])
        ->name('admin.bookings');

    /*
    |--------------------------------------------------------------------------
    | BOOKING STATUS
    |--------------------------------------------------------------------------
    */

    Route::patch('/admin/bookings/{booking}/status',
        [BookingController::class, 'updateStatus'])
        ->name('admin.bookings.status');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
