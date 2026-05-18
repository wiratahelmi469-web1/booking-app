@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-8">

    Dashboard Statistics

</h1>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- TOTAL BOOKINGS -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-gray-500 mb-2">

            Total Bookings

        </h2>

        <p class="text-4xl font-bold text-blue-500">

            {{ $totalBookings }}

        </p>

    </div>

    <!-- TOTAL SERVICES -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-gray-500 mb-2">

            Total Services

        </h2>

        <p class="text-4xl font-bold text-green-500">

            {{ $totalServices }}

        </p>

    </div>

    <!-- TOTAL USERS -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-gray-500 mb-2">

            Total Users

        </h2>

        <p class="text-4xl font-bold text-purple-500">

            {{ $totalUsers }}

        </p>

    </div>

    <!-- PENDING -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-gray-500 mb-2">

            Pending Bookings

        </h2>

        <p class="text-4xl font-bold text-yellow-500">

            {{ $pendingBookings }}

        </p>

    </div>

    <!-- COMPLETED -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-gray-500 mb-2">

            Completed Bookings

        </h2>

        <p class="text-4xl font-bold text-green-600">

            {{ $completedBookings }}

        </p>

    </div>

    <!-- REVENUE -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-gray-500 mb-2">

            Revenue

        </h2>

        <p class="text-4xl font-bold text-red-500">

            Rp {{ number_format($revenue) }}

        </p>

    </div>

</div>

@endsection
