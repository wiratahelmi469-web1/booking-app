@extends('layouts.user')

@section('content')

<!-- HERO -->
<div class="relative rounded-3xl overflow-hidden mb-10">

    <div class="h-[320px] bg-gradient-to-r from-blue-700 to-blue-500">

        <div class="absolute inset-0 bg-black/30"></div>

        <div class="relative z-10 h-full flex flex-col justify-center px-10">

            <h1 class="text-5xl font-bold text-white mb-4">

                Find Your Perfect Booking ✨

            </h1>

            <p class="text-blue-100 text-lg max-w-2xl mb-8">

                Book premium services quickly and easily with modern experience.

            </p>

            <!-- SEARCH -->
           <form action="/dashboard"
                method="GET"
                class="bg-white rounded-2xl p-3 max-w-2xl shadow-2xl">

                <div class="flex flex-col md:flex-row gap-3">

                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search services..."
                        class="flex-1 border-0 focus:ring-0 text-lg rounded-xl">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl transition">

                        Search

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

    <!-- TOTAL -->
    <div class="bg-white rounded-3xl p-6 shadow-lg">

        <p class="text-gray-500 mb-2">

            Total Bookings

        </p>

        <h2 class="text-4xl font-bold text-gray-800">

            {{ $totalBookings }}

        </h2>

    </div>

    <!-- PENDING -->
    <div class="bg-yellow-100 rounded-3xl p-6 shadow-lg">

        <p class="text-yellow-700 mb-2">

            Pending

        </p>

        <h2 class="text-4xl font-bold text-yellow-800">

            {{ $pendingBookings }}

        </h2>

    </div>

    <!-- COMPLETED -->
    <div class="bg-green-100 rounded-3xl p-6 shadow-lg">

        <p class="text-green-700 mb-2">

            Completed

        </p>

        <h2 class="text-4xl font-bold text-green-800">

            {{ $completedBookings }}

        </h2>

    </div>

    <!-- CANCELLED -->
    <div class="bg-red-100 rounded-3xl p-6 shadow-lg">

        <p class="text-red-700 mb-2">

            Cancelled

        </p>

        <h2 class="text-4xl font-bold text-red-800">

            {{ $cancelledBookings }}

        </h2>

    </div>

</div>

<!-- SERVICES -->
<div class="mb-12">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h2 class="text-3xl font-bold text-gray-800">

                Featured Services

            </h2>

            <p class="text-gray-500">

                Explore our best services

            </p>

        </div>

        <a href="/booking"
           class="text-blue-600 hover:text-blue-700 font-semibold">

            View All

        </a>

    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

        @forelse($services as $service)

            <!-- CARD -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition duration-300 group">

                <!-- IMAGE -->
                <div class="relative h-64 overflow-hidden">

                    @if($service->image)

                        <img src="{{ asset('storage/'.$service->image) }}"
                             alt="{{ $service->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                    @else

                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">

                            No Image

                        </div>

                    @endif

                    <!-- PRICE -->
                    <div class="absolute top-4 right-4 bg-white shadow-lg px-4 py-2 rounded-full">

                        <span class="font-bold text-blue-600">

                            Rp {{ number_format($service->price) }}

                        </span>

                    </div>

                </div>

                <!-- CONTENT -->
                <div class="p-6">

                    <!-- TITLE -->
                    <h2 class="text-2xl font-bold text-gray-800 mb-3">

                        {{ $service->name }}

                    </h2>

                    <!-- DESCRIPTION -->
                    <p class="text-gray-500 mb-6 line-clamp-3">

                        {{ $service->description }}

                    </p>

                    <!-- BUTTON -->
                    <a href="/booking"
                       class="block text-center bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition">

                        Book Now

                    </a>

                </div>

            </div>

        @empty

            <!-- EMPTY -->
            <div class="col-span-full">

                <div class="bg-white rounded-3xl p-10 shadow text-center">

                    <h2 class="text-2xl font-bold text-gray-700 mb-2">

                        No Services Available

                    </h2>

                    <p class="text-gray-500">

                        Please wait until admin adds new services.

                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>

<!-- RECENT BOOKINGS -->
<div>

    <div class="mb-6">

        <h2 class="text-3xl font-bold text-gray-800">

            Recent Bookings

        </h2>

        <p class="text-gray-500">

            Your latest booking activity

        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left py-4 px-6">

                            Service

                        </th>

                        <th class="text-left py-4 px-6">

                            Date

                        </th>

                        <th class="text-left py-4 px-6">

                            Status

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($recentBookings as $booking)

                        <tr class="border-t">

                            <td class="py-4 px-6 font-semibold">

                                {{ $booking->service->name }}

                            </td>

                            <td class="py-4 px-6 text-gray-500">

                                {{ $booking->booking_date }}

                            </td>

                            <td class="py-4 px-6">

                                @if($booking->status == 'pending')

                                    <span class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded-full text-sm">

                                        Pending

                                    </span>

                                @elseif($booking->status == 'completed')

                                    <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">

                                        Completed

                                    </span>

                                @elseif($booking->status == 'cancelled')

                                    <span class="bg-red-100 text-red-700 px-4 py-1 rounded-full text-sm">

                                        Cancelled

                                    </span>

                                @else

                                    <span class="bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm">

                                        Approved

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3"
                                class="py-10 text-center text-gray-400">

                                No bookings yet

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
