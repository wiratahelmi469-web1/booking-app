<?php

use Illuminate\Http\Request;
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

        /*
        |--------------------------------------------------------------------------
        | BOOKING STATISTICS
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | RECENT BOOKINGS
        |--------------------------------------------------------------------------
        */

        $recentBookings = Booking::with('service')
            ->where(
                'user_id',
                $user->id
            )
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | SEARCH SERVICES
        |--------------------------------------------------------------------------
        */

        $search = request('search');

        $services = Service::when(
            $search,
            function ($query) use ($search) {

                $query->where(
                    'name',
                    'like',
                    "%{$search}%"
                )->orWhere(
                    'description',
                    'like',
                    "%{$search}%"
                );

            }
        )->latest()->take(6)->get();

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'completedBookings',
            'cancelledBookings',
            'recentBookings',
            'services',
            'search'
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
    | UPDATE PROFILE PHOTO
    |--------------------------------------------------------------------------
    */

    Route::post('/profile/update-photo', function (Request $request) {

        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::find(auth()->id());

        if ($request->hasFile('profile_photo')) {

            $photo = $request->file('profile_photo')
                ->store('profiles', 'public');

            $user->update([
                'profile_photo' => $photo,
            ]);

        }

        return back()->with(
            'success',
            'Profile photo updated successfully'
        );

    })->name('profile.photo');

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE INFORMATION
    |--------------------------------------------------------------------------
    */

    Route::put('/profile/update', function (Request $request) {

        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user = User::find(auth()->id());

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {

            $data['password'] = bcrypt(
                $request->password
            );

        }

        $user->update($data);

        return back()->with(
            'success',
            'Profile updated successfully'
        );

    })->name('profile.update');

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

        /*
        |--------------------------------------------------------------------------
        | TOTAL DATA
        |--------------------------------------------------------------------------
        */

        $totalBookings = Booking::count();

        $totalServices = Service::count();

        $totalUsers = User::count();

        /*
        |--------------------------------------------------------------------------
        | BOOKING STATUS
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | REVENUE
        |--------------------------------------------------------------------------
        */

        $revenue = Booking::where(
            'status',
            'completed'
        )->with('service')->get()->sum(function ($booking) {

            return $booking->service->price ?? 0;

        });

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

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
    | ADMIN SERVICES
    |--------------------------------------------------------------------------
    */

    Route::resource(
        '/admin/services',
        ServiceController::class
    );

    /*
    |--------------------------------------------------------------------------
    | ADMIN BOOKINGS
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
