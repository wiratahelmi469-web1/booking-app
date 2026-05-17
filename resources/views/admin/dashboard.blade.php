@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-8">

    Dashboard Admin

</h1>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- TOTAL BOOKINGS -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-gray-500 text-sm mb-2">

            Total Bookings

        </h2>

        <p class="text-4xl font-bold text-blue-500">

            {{ $totalBookings }}

        </p>

    </div>

    <!-- TOTAL SERVICES -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-gray-500 text-sm mb-2">

            Total Services

        </h2>

        <p class="text-4xl font-bold text-green-500">

            {{ $totalServices }}

        </p>

    </div>

    <!-- TOTAL USERS -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-gray-500 text-sm mb-2">

            Total Users

        </h2>

        <p class="text-4xl font-bold text-purple-500">

            {{ $totalUsers }}

        </p>

    </div>

    <!-- PENDING BOOKINGS -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-gray-500 text-sm mb-2">

            Pending Bookings

        </h2>

        <p class="text-4xl font-bold text-yellow-500">

            {{ $pendingBookings }}

        </p>

    </div>

</div>

@endsection
