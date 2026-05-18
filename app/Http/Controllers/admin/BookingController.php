<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display services page
     */
    public function services()
    {
        $services = Service::latest()->get();

        return view(
            'services.index',
            compact('services')
        );
    }

    /**
     * Display single service
     */
    public function show(Service $service)
    {
        return view(
            'services.show',
            compact('service')
        );
    }

    /**
     * Show booking form
     */
    public function create()
    {
        $search = request('search');

        $services = Service::when($search, function ($query) use ($search) {

            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");

        })->latest()->get();

        return view(
            'booking.create',
            compact(
                'services',
                'search'
            )
        );
    }

    /**
     * Store booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id'   => 'required',
            'booking_date' => 'required|date',
            'notes'        => 'nullable',
        ]);

        Booking::create([
            'user_id'      => auth()->id(),
            'service_id'   => $request->service_id,
            'booking_date' => $request->booking_date,
            'notes'        => $request->notes,
            'status'       => 'pending',
        ]);

        return redirect('/my-bookings')
            ->with(
                'success',
                'Booking created successfully'
            );
    }

    /**
     * Display all bookings (Admin)
     */
    public function index()
    {
        $bookings = Booking::with([
            'user',
            'service'
        ])->latest()->get();

        return view(
            'admin.bookings.index',
            compact('bookings')
        );
    }

    /**
     * Update booking status
     */
    public function updateStatus(
        Request $request,
        Booking $booking
    ) {
        $booking->update([

            'status' => $request->status,

        ]);

        return back()->with(
            'success',
            'Booking status updated successfully'
        );
    }

    /**
     * User booking history
     */
    public function history()
    {
        $bookings = Booking::with('service')
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->get();

        return view(
            'booking.history',
            compact('bookings')
        );
    }

}
