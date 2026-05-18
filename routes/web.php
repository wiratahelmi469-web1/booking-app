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

        $user = auth()->user();

        $totalBookings = Booking::where(
            'user_id',
            $user->id
        )->count();

        $pendingBookings = Booking::where(
            'user_id',
            $user->id
        )->where(
            'status',
            'pending'
        )->count();

        $completedBookings = Booking::where(
            'user_id',
            $user->id
        )->where(
            'status',
            'completed'
        )->count();

        $cancelledBookings = Booking::where(
            'user_id',
            $user->id
        )->where(
            'status',
            'cancelled'
        )->count();

        $recentBookings = Booking::with('service')
            ->where(
                'user_id',
                $user->id
            )
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'completedBookings',
            'cancelledBookings',
            'recentBookings'
        ));

    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', function () {

        return view('profile.index');

    })->name('profile');

    /*
    |--------------------------------------------------------------------------
    | SERVICES
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/services',
        [BookingController::class, 'services']
    )->name('services.index');

    Route::get(
        '/services/{service}',
        [BookingController::class, 'show']
    )->name('services.show');

    /*
    |--------------------------------------------------------------------------
    | BOOKING
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/booking',
        [BookingController::class, 'create']
    )->name('booking.create');

    Route::post(
        '/booking',
        [BookingController::class, 'store']
    )->name('booking.store');

    /*
    |--------------------------------------------------------------------------
    | BOOKING HISTORY
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/my-bookings',
        [BookingController::class, 'history']
    )->name('booking.history');

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

        return view('admin.dashboard', compact(
            'totalBookings',
            'totalServices',
            'totalUsers',
            'pendingBookings',
            'completedBookings'
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

    Route::get(
        '/admin/bookings',
        [BookingController::class, 'index']
    )->name('admin.bookings');

    /*
    |--------------------------------------------------------------------------
    | UPDATE BOOKING STATUS
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/admin/bookings/{booking}/status',
        [BookingController::class, 'updateStatus']
    )->name('admin.bookings.status');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
