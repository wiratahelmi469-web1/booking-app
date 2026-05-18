@extends('layouts.user')

@section('content')

<!-- HERO -->
<div class="mb-10">

    <h1 class="text-4xl font-bold text-gray-800 mb-2">

        Welcome back,
        {{ auth()->user()->name }} 👋

    </h1>

    <p class="text-gray-500">

        Manage your bookings easily and quickly.

    </p>

</div>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

    <!-- TOTAL -->
    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">

        <p class="text-gray-500 mb-2">

            Total Bookings

        </p>

        <h2 class="text-4xl font-bold text-blue-500">

            {{ $totalBookings }}

        </h2>

    </div>

    <!-- PENDING -->
    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">

        <p class="text-gray-500 mb-2">

            Pending

        </p>

        <h2 class="text-4xl font-bold text-yellow-500">

            {{ $pendingBookings }}

        </h2>

    </div>

    <!-- COMPLETED -->
    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">

        <p class="text-gray-500 mb-2">

            Completed

        </p>

        <h2 class="text-4xl font-bold text-green-500">

            {{ $completedBookings }}

        </h2>

    </div>

    <!-- CANCELLED -->
    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">

        <p class="text-gray-500 mb-2">

            Cancelled

        </p>

        <h2 class="text-4xl font-bold text-red-500">

            {{ $cancelledBookings }}

        </h2>

    </div>

</div>

<!-- QUICK ACTION -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

    <!-- BOOK -->
    <a href="/booking"
       class="bg-blue-600 text-white p-8 rounded-2xl shadow hover:shadow-xl transition">

        <h2 class="text-2xl font-bold mb-2">

            Book Service

        </h2>

        <p class="text-blue-100">

            Create a new booking easily.

        </p>

    </a>

    <!-- HISTORY -->
    <a href="/my-bookings"
       class="bg-white p-8 rounded-2xl shadow hover:shadow-xl transition border">

        <h2 class="text-2xl font-bold mb-2 text-gray-800">

            Booking History

        </h2>

        <p class="text-gray-500">

            Check your recent bookings.

        </p>

    </a>

</div>

<!-- RECENT BOOKINGS -->
<div class="bg-white rounded-2xl shadow p-6">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-2xl font-bold text-gray-800">

            Recent Bookings

        </h2>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-3">
                        Service
                    </th>

                    <th class="text-left py-3">
                        Date
                    </th>

                    <th class="text-left py-3">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($recentBookings as $booking)

                    <tr class="border-b">

                        <!-- SERVICE -->
                        <td class="py-4">

                            {{ $booking->service->name }}

                        </td>

                        <!-- DATE -->
                        <td class="py-4">

                            {{ $booking->booking_date }}

                        </td>

                        <!-- STATUS -->
                        <td class="py-4">

                            @if($booking->status == 'pending')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                    Pending

                                </span>

                            @elseif($booking->status == 'completed')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                    Completed

                                </span>

                            @elseif($booking->status == 'cancelled')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                    Cancelled

                                </span>

                            @else

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                    Approved

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3"
                            class="text-center py-6 text-gray-400">

                            No bookings found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
