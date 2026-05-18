<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show booking form
     */
    public function create()
    {
        $services = Service::latest()->get();

        return view(
            'booking.create',
            compact('services')
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

        return redirect('/booking')
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
                auth()->user()->id
            )
            ->latest()
            ->get();

        return view(
            'booking.history',
            compact('bookings')
        );
    }
}
